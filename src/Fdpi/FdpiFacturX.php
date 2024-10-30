<?php

/*
 * This file is part of PHP Factur-X library.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tiime\FacturX\Fdpi;

use Ramsey\Uuid\Uuid;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\Type\PdfIndirectObject;
use setasign\Fpdi\PdfParser\Type\PdfType;
use Tiime\FacturX\Exception;

class FdpiFacturX extends Fpdi
{
    private const string ICC_PROFILE_PATH = __DIR__ . \DIRECTORY_SEPARATOR . 'icc' . \DIRECTORY_SEPARATOR . 'sRGB2014.icc';
    protected array $files                = []; // @phpstan-ignore-line
    protected int $nFiles;
    protected int $outputIntentIndex       = 0;
    protected int $fileSpecDictionaryIndex = 0;
    protected int $descriptionIndex        = 0;

    public function __construct(
        private readonly string $xmlSeller,
        private readonly string $xmlDocumentTypeName,
        private readonly string $xmlInvoiceId,
        private readonly \DateTime $xmlDateTime,
        private readonly string $xmlUrn,
        private readonly string $xmlDocumentType,
        private readonly string $xmlFilename,
        private readonly string $xmlVersion,
        private readonly string $xmlXmpLevel,
        private readonly bool $openAttachmentPane = true,
        string $orientation = 'P',
        string $unit = 'mm',
        string $size = 'A4',
        string $pdfVersion = '1.3',
        bool $binaryData = false,
    ) {
        parent::__construct($orientation, $unit, $size);

        $this->PDFVersion = \sprintf('%.1F', $pdfVersion);

        if ($binaryData) {
            $this->PDFVersion .= "\n" . '%' . \chr(rand(128, 256)) . \chr(rand(128, 256)) . \chr(rand(128, 256)) . \chr(rand(128, 256));
        }
    }

    /**
     * Put resources including files and metadata descriptions.
     *
     * @throws \Exception
     */
    protected function _putresources(): void
    {
        parent::_putresources();

        if ([] !== $this->files) {
            $this->putFiles();
        }

        $this->putOutputIntent();
        $this->addXmlMetadata();
    }

    protected function putFiles(): void
    {
        foreach ($this->files as &$info) {
            /*
             * Add file specification
             */
            $this->_newobj();
            $this->fileSpecDictionaryIndex = $this->n;

            $formattedFileName = $this->_textstring(mb_convert_encoding($info['name'], 'UTF-8'));

            $this->_put('<<');
            $this->_put(\sprintf('/F %s', $formattedFileName));
            $this->_put('/Type /Filespec');
            $this->_put(\sprintf('/UF %s', $formattedFileName));

            if ($info['relationship']) {
                $this->_put(\sprintf('/AFRelationship /%s', $info['relationship']));
            }

            if ($info['desc']) {
                $this->_put(\sprintf('/Desc %s', $this->_textstring(mb_convert_encoding($info['desc'], 'UTF-8'))));
            }

            $countToDisplay = $this->n + 1;

            $this->_put('/EF <<');
            $this->_put(\sprintf('/F %s 0 R', $countToDisplay));
            $this->_put(\sprintf('/UF %s 0 R', $countToDisplay));
            $this->_put('>>');
            $this->_put('>>');
            $this->_put('endobj');

            $info['file_index'] = $this->n;

            /*
             * Add file stream
             */
            $this->_newobj();
            $this->_put('<<');
            $this->_put('/Filter /FlateDecode');

            if ($info['subtype']) {
                $this->_put(\sprintf('/Subtype /%s', $info['subtype']));
            }

            $this->_put('/Type /EmbeddedFile');

            if (\is_string($info['file']) && @is_file($info['file'])) {
                $fc = file_get_contents($info['file']);
                $md = @date('YmdHis', false !== filemtime($info['file']) ? filemtime($info['file']) : null);
            } else {
                $stream = $info['file']->getStream();
                fseek($stream, 0);
                $fc = stream_get_contents($stream);
                $md = @date('YmdHis');
            }

            if (false === $fc) {
                throw new Exception(\sprintf('FPDP Error, cannot open file: %s', $info['file']));
            }

            $fc = gzcompress($fc);
            $this->_put(\sprintf('/Length %s', \strlen($fc))); // @phpstan-ignore-line
            $this->_put("/Params <</ModDate (D:$md)>>");
            $this->_put('>>');
            $this->_putstream($fc);
            $this->_put('endobj');
        }
        unset($info);

        /*
         * Add file dictionary
         */
        $this->_newobj();
        $this->nFiles = $this->n;
        $this->_put('<<');
        $s     = '';
        $files = $this->files;

        /*
         * Sorting files in name order as PDF specs (if not, issue with Acrobat Reader when trying to download attachments)
         */
        usort($files, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        foreach ($files as $info) {
            $s .= \sprintf('%s %s 0 R ', $this->_textstring($info['name']), $info['file_index']);
        }

        $this->_put(\sprintf('/Names [%s]', $s));
        $this->_put('>>');
        $this->_put('endobj');
    }

    protected function putOutputIntent(): void
    {
        $this->_newobj();
        $this->_put('<<');
        $this->_put('/Type /OutputIntent');
        $this->_put('/S /GTS_PDFA1');
        $this->_put('/OuputCondition (sRGB)');
        $this->_put('/OutputConditionIdentifier (Custom)');
        $this->_put('/DestOutputProfile ' . ($this->n + 1) . ' 0 R');
        $this->_put('/Info (sRGB V4 ICC)');
        $this->_put('>>');
        $this->_put('endobj');

        $this->outputIntentIndex = $this->n;

        $icc = file_get_contents($this::ICC_PROFILE_PATH);
        \assert(\is_string($icc));
        $icc = gzcompress($icc);
        $this->_newobj();
        $this->_put('<<');
        $this->_put(\sprintf('/Length %s', \strlen($icc))); // @phpstan-ignore-line
        $this->_put('/N 3');
        $this->_put('/Filter /FlateDecode');
        $this->_put('>>');
        $this->_putstream($icc);
        $this->_put('endobj');
    }

    public function addXmlMetadata(): void
    {
        $title   = \sprintf('%s : %s %s', $this->xmlSeller, $this->xmlDocumentTypeName, $this->xmlInvoiceId);
        $author  = $this->xmlSeller;
        $subject = \sprintf(
            'Factur-X %s %s dated %s issued by %s',
            $this->xmlDocumentTypeName,
            $this->xmlInvoiceId,
            $this->xmlDateTime->format('Y-m-d'),
            $this->xmlSeller
        );
        $producer    = 'FPDF';
        $creatorTool = 'Factur-X PHP library by Tiime';
        $timestamp   = (new \DateTime('now', new \DateTimeZone('UTC')))->format('Y-m-d\TH:i:sP');

        $xmlString = <<<XML
<?xpacket begin="\ufeff" id="W5M0MpCehiHzreSzNTczkc9d"?>
<x:xmpmeta xmlns:x="adobe:ns:meta/">
  <rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
    <rdf:Description xmlns:pdfaid="http://www.aiim.org/pdfa/ns/id/" rdf:about="">
      <pdfaid:part>3</pdfaid:part>
      <pdfaid:conformance>B</pdfaid:conformance>
    </rdf:Description>
    <rdf:Description xmlns:dc="http://purl.org/dc/elements/1.1/" rdf:about="">
      <dc:title>
        <rdf:Alt>
          <rdf:li xml:lang="x-default">{$title}</rdf:li>
        </rdf:Alt>
      </dc:title>
      <dc:creator>
        <rdf:Seq>
          <rdf:li>{$author}</rdf:li>
        </rdf:Seq>
      </dc:creator>
      <dc:description>
        <rdf:Alt>
          <rdf:li xml:lang="x-default">{$subject}</rdf:li>
        </rdf:Alt>
      </dc:description>
    </rdf:Description>
    <rdf:Description xmlns:pdf="http://ns.adobe.com/pdf/1.3/" rdf:about="">
      <pdf:Producer>{$producer}</pdf:Producer>
    </rdf:Description>
    <rdf:Description xmlns:xmp="http://ns.adobe.com/xap/1.0/" rdf:about="">
      <xmp:CreatorTool>{$creatorTool}</xmp:CreatorTool>
      <xmp:CreateDate>{$timestamp}</xmp:CreateDate>
      <xmp:ModifyDate>{$timestamp}</xmp:ModifyDate>
    </rdf:Description>
    <rdf:Description xmlns:pdfaExtension="http://www.aiim.org/pdfa/ns/extension/" xmlns:pdfaSchema="http://www.aiim.org/pdfa/ns/schema#" xmlns:pdfaProperty="http://www.aiim.org/pdfa/ns/property#" rdf:about="">
      <pdfaExtension:schemas>
        <rdf:Bag>
          <rdf:li rdf:parseType="Resource">
            <pdfaSchema:schema>Factur-X PDFA Extension Schema</pdfaSchema:schema>
            <pdfaSchema:namespaceURI>{$this->xmlUrn}</pdfaSchema:namespaceURI>
            <pdfaSchema:prefix>fx</pdfaSchema:prefix>
            <pdfaSchema:property>
              <rdf:Seq>
                <rdf:li rdf:parseType="Resource">
                  <pdfaProperty:name>DocumentFileName</pdfaProperty:name>
                  <pdfaProperty:valueType>Text</pdfaProperty:valueType>
                  <pdfaProperty:category>external</pdfaProperty:category>
                  <pdfaProperty:description>The name of the embedded XML document</pdfaProperty:description>
                </rdf:li>
                <rdf:li rdf:parseType="Resource">
                  <pdfaProperty:name>DocumentType</pdfaProperty:name>
                  <pdfaProperty:valueType>Text</pdfaProperty:valueType>
                  <pdfaProperty:category>external</pdfaProperty:category>
                  <pdfaProperty:description>The type of the hybrid document in capital letters, e.g. INVOICE or ORDER</pdfaProperty:description>
                </rdf:li>
                <rdf:li rdf:parseType="Resource">
                  <pdfaProperty:name>Version</pdfaProperty:name>
                  <pdfaProperty:valueType>Text</pdfaProperty:valueType>
                  <pdfaProperty:category>external</pdfaProperty:category>
                  <pdfaProperty:description>The actual version of the standard applying to the embedded XML document</pdfaProperty:description>
                </rdf:li>
                <rdf:li rdf:parseType="Resource">
                  <pdfaProperty:name>ConformanceLevel</pdfaProperty:name>
                  <pdfaProperty:valueType>Text</pdfaProperty:valueType>
                  <pdfaProperty:category>external</pdfaProperty:category>
                  <pdfaProperty:description>The conformance level of the embedded XML document</pdfaProperty:description>
                </rdf:li>
              </rdf:Seq>
            </pdfaSchema:property>
          </rdf:li>
        </rdf:Bag>
      </pdfaExtension:schemas>
    </rdf:Description>
    <rdf:Description xmlns:fx="{$this->xmlUrn}" rdf:about="">
      <fx:DocumentType>{$this->xmlDocumentType}</fx:DocumentType>
      <fx:DocumentFileName>{$this->xmlFilename}</fx:DocumentFileName>
      <fx:Version>{$this->xmlVersion}</fx:Version>
      <fx:ConformanceLevel>{$this->xmlXmpLevel}</fx:ConformanceLevel>
    </rdf:Description>
  </rdf:RDF>
</x:xmpmeta>
<?xpacket end="w"?>
XML;

        $xmlXmp = mb_convert_encoding($xmlString, 'UTF-8');

        $this->_newobj();
        $this->descriptionIndex = $this->n;
        $this->_put('<<');
        $this->_put(\sprintf('/Length %s', \strlen($xmlXmp)));
        $this->_put('/Type /Metadata');
        $this->_put('/Subtype /XML');
        $this->_put('>>');
        $this->_putstream($xmlXmp);
        $this->_put('endobj');
    }

    // @phpstan-ignore-next-line
    public function attach(
        $file,
        string $name = '',
        string $desc = '',
        string $relationship = 'Unspecified',
        string $mimetype = '',
        bool $isUTF8 = false,
    ): void {
        if ('' === $name) {
            $p = mb_strrpos($file, '/');

            if (false === $p) {
                $p = mb_strrpos($file, '\\');
            }

            if (false !== $p) {
                $name = mb_substr($file, $p + 1);
            } else {
                $name = $file;
            }
        }

        if (!$isUTF8) {
            $desc = mb_convert_encoding($desc, 'UTF-8');
        }

        if ('' === $mimetype) {
            $mimetype = mime_content_type($file);

            if (!$mimetype) {
                $mimetype = 'application/octet-stream';
            }
        }

        $mimetype      = str_replace('/', '#2F', $mimetype);
        $this->files[] = ['file' => $file, 'name' => $name, 'desc' => $desc, 'relationship' => $relationship, 'subtype' => $mimetype];
    }

    /**
     * Put catalog node, including associated files.
     */
    protected function _putcatalog(): void
    {
        parent::_putcatalog();

        if ([] !== $this->files) {
            $filesRefStr = '';

            foreach ($this->files as $file) {
                if ('' !== $filesRefStr) {
                    $filesRefStr .= ' ';
                }

                $filesRefStr .= \sprintf('%s 0 R', $file['file_index']);
            }

            $this->_put(\sprintf('/AF [%s]', $filesRefStr));

            if (0 !== $this->descriptionIndex) {
                $this->_put(\sprintf('/Metadata %s 0 R', $this->descriptionIndex));
            }

            $this->_put('/Names <<');
            $this->_put('/EmbeddedFiles ');
            $this->_put(\sprintf('%s 0 R', $this->nFiles));
            $this->_put('>>');
        }

        if (0 !== $this->outputIntentIndex) {
            $this->_put(\sprintf('/OutputIntents [%s 0 R]', $this->outputIntentIndex));
        }

        if ($this->openAttachmentPane) {
            $this->_put('/PageMode /UseAttachments');
        }
    }

    protected function writePdfType(PdfType $value): void
    {
        parent::writePdfType($value);

        if ($value instanceof PdfIndirectObject && \PHP_EOL !== mb_substr($this->buffer, -1)) {
            $this->_put('');
        }
    }

    public function setModifiedDate(string $date, bool $isUTF8 = false): void
    {
        $this->metadata['ModDate'] = $isUTF8 ? $date : mb_convert_encoding($date, 'UTF-8');
    }

    public function setCreationDate(string $date, bool $isUTF8 = false): void
    {
        $this->metadata['CreationDate'] = $isUTF8 ? $date : mb_convert_encoding($date, 'UTF-8');
    }

    protected function _puttrailer(): void
    {
        parent::_puttrailer();
        $this->_put(\sprintf('/ID [<%s><%s>]', md5(Uuid::uuid7()->toString()), md5(Uuid::uuid7()->toString())));
    }
}
