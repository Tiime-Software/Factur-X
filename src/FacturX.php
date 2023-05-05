<?php

declare(strict_types=1);

namespace Tiime\FacturX;

use Atgp\FacturX\Fpdi\FdpiFacturx;
use setasign\Fpdi\PdfParser\StreamReader;
use Smalot\PdfParser\Parser;

class FacturX
{
    private const FACTURX_FILENAME = 'factur-x.xml';

    private string $pdfContent;

    private string $xmlContent;

    private \Atgp\FacturX\Facturx $facturxManager;

    public function __construct(string $pdfContent, ?string $xmlContent = null)
    {
        $this->facturxManager = new \Atgp\FacturX\Facturx();

        try {
            $pdfXml = $this->getXmlFromPdf($pdfContent);
        } catch (PdfParserException $e) {
            throw new \Exception('Impossible to parse the PDF provided.');
        }

        if (is_string($pdfXml) && is_string($xmlContent)) {
            throw new \Exception(
                'The provided PDF already contains an XML, so it is not possible to fill the $xmlContent.'
            );
        }

        if (is_string($pdfXml)) {
            try {
                $this->checkXmlWithXsd($pdfXml);
            } catch (\Exception $e) {
                throw new \Exception('The PDF provided must contain a valid XML.');
            }
        }

        if (!is_string($pdfXml) && !is_string($xmlContent)) {
            throw new \Exception(
                'FacturX must contain a PDF with a valid XML or be created with a valid XML to be inserted in the PDF.'
            );
        }

        if (is_string($xmlContent)) {
            try {
                $this->checkXmlWithXsd($xmlContent);
            } catch (\Exception $e) {
                throw new \Exception('The XML provided must be valid.');
            }
        }

        if (!is_string($pdfXml) && is_string($xmlContent)) {
            try {
                $this->facturxManager->generateFacturxFromFiles($pdfContent, $xmlContent, checkXsd: false);
            } catch (\Exception $e) {
                throw new \Exception('An error occurred during the creation of the Factur-X file.');
            }
        }

        $this->pdfContent = $pdfContent;

        /** @var string $pdfXml */
        $this->xmlContent = is_string($xmlContent) ? $xmlContent : $pdfXml;
    }

    public function getXmlContent(): string
    {
        return $this->xmlContent;
    }

    public function getPdfContent(): string
    {
        return $this->pdfContent;
    }

    public function addFacturxLogo(): void
    {
        $document = new \DOMDocument();
        $document->loadXML($this->xmlContent);

        $profile = $this->getXmlProfile($document);
        $pdfStreamReader = StreamReader::createByString($this->pdfContent);

        $pdfWriter = new FdpiFacturx();
        $pageCount = $pdfWriter->setSourceFile($pdfStreamReader);

        for ($i = 1; $i <= $pageCount; ++$i) {
            $tplIdx = $pdfWriter->importPage($i, '/MediaBox');
            $pdfWriter->AddPage();
            $pdfWriter->useTemplate($tplIdx, 0, 0, null, null, true);

            if (1 === $i) {
                $pdfWriter->Image(
                    sprintf(
                        '%s%s%s',
                        __DIR__,
                        '/../vendor/atgp/factur-x/img/',
                        \Atgp\FacturX\Facturx::FACTURX_LOGO[$profile]
                    ),
                    197,
                    2.5,
                    7
                );
            }
        }

        $pdfWriter->SetPDFVersion('1.7', true);

        $this->pdfContent = $pdfWriter->Output('invoice-facturx-' . date('Ymdhis') . '.pdf', 'S');
    }

    /**
     * @param array<int, FacturXAttachment> $additionalAttachments
     */
    public function addAttachments(iterable $additionalAttachments): void
    {
        foreach ($additionalAttachments as $additionalAttachment) {
            if (!$additionalAttachment instanceof FacturXAttachment) {
                throw new \Exception('An additional attachment must be an instance of FacturXAttachment.');
            }
        }

        $pdfStreamReader = StreamReader::createByString($this->pdfContent);

        $pdfWriter = new FdpiFacturx();
        $pdfWriter->setSourceFile($pdfStreamReader);

        /** @var FacturXAttachment $additionalAttachment */
        foreach ($additionalAttachments as $additionalAttachment) {
            $attachmentFilePath = sprintf("%s/%s", sys_get_temp_dir(), uniqid());

            // creating tmp file to solve mime_content_type errors
            file_put_contents($attachmentFilePath, $additionalAttachment->getContent());

            $pdfWriter->Attach(
                $attachmentFilePath,
                $additionalAttachment->getFilename(),
                $additionalAttachment->getDescription()
            );
        }

        $pdfWriter->OpenAttachmentPane();
        $pdfWriter->SetPDFVersion('1.7', true);

        $this->pdfContent = $pdfWriter->Output('invoice-facturx-' . date('Ymdhis') . '.pdf', 'S');
    }


    private function getXmlFromPdf(string $pdfContent): ?string
    {
        $extractedXml = null;
        $pdfParser = new Parser();

        try {
            $parsedPdf = $pdfParser->parseContent($pdfContent);
        } catch (\Exception $e) {
            throw new PdfParserException('Unable to get Factur-X XML from PDF : ' . $e);
        }

        $filespecs = $parsedPdf->getObjectsByType('Filespec');

        $facturxFound = false;
        $facturxLength = null;

        foreach ($filespecs as $filespec) {
            $filespecDetails = $filespec->getDetails();

            if (FacturX::FACTURX_FILENAME === $filespecDetails['F']) {
                $facturxFound = true;

                if (
                    !empty($filespecDetails['EF'])
                    && isset($filespecDetails['EF']['F'])
                    && isset($filespecDetails['EF']['F']['Length'])
                ) {
                    $facturxLength = $filespecDetails['EF']['F']['Length']; // Get file size
                }

                break;
            }
        }

        if (true === $facturxFound) {
            $embeddedFiles = $parsedPdf->getObjectsByType('EmbeddedFile');

            foreach ($embeddedFiles as $embeddedFile) {
                $embeddedFileDetails = $embeddedFile->getDetails();

                // looking for file with same file length as found before, if empty length, take first EmbeddedFile
                if ($embeddedFileDetails['Length'] == $facturxLength || null == $facturxLength) {
                    $extractedXml = $embeddedFile->getContent();
                }
            }
        }

        return $extractedXml;
    }

    private function checkXmlWithXsd(string $xmlContent, ?string $profile = null): bool
    {
        $document = new \DOMDocument();
        $document->loadXML($xmlContent);

        if (!is_string($profile)) {
            $profile = $this->getXmlProfile($document);
        }

        if (!array_key_exists($profile, \Atgp\FacturX\Facturx::FACTURX_PROFIL_TO_XSD)) {
            throw new \Exception("Wrong profile '$profile' for Factur-X invoice.");
        }

        $xsdFilename = \Atgp\FacturX\Facturx::FACTURX_PROFIL_TO_XSD[$profile];
        $xsdFile = __DIR__ . '/../vendor/atgp/factur-x/xsd/' . $xsdFilename;

        try {
            libxml_use_internal_errors(true);

            $validatedSchema = $document->schemaValidate($xsdFile);

            if (false === $validatedSchema) {
                $errors = libxml_get_errors();
                $errorsMessage = '';

                foreach ($errors as $error) {
                    $errorsMessage .= sprintf('XML error "%s"' . "\n", $error->message);
                }

                libxml_clear_errors();
                libxml_use_internal_errors(false);

                throw new \Exception(strtoupper($profile) . ' XML file invalid schema : ' . $errorsMessage);
            }
        } catch (\Exception $e) {
            throw new \Exception('The ' . strtoupper($profile) . " XML file is not valid against the official
            XML Schema Definition : $e.");
        }

        return true;
    }

    private function getXmlProfile(\DOMDocument $xml): string
    {
        $xpath = new \DOMXpath($xml);

        /** @var \DOMNodeList<\DOMDocument> $elements */
        $elements = $xpath->query(
            '//rsm:ExchangedDocumentContext/ram:GuidelineSpecifiedDocumentContextParameter/ram:ID'
        );

        if (0 === $elements->count()) {
            throw new \Exception('This XML is not a Factur-X XML because it misses the XML
                tag ExchangedDocumentContext/GuidelineSpecifiedDocumentContextParameter/ID.');
        }

        $documentIdentifierItem = $elements->item(0);

        if (!$documentIdentifierItem instanceof \DOMDocument) {
            throw new \Exception('The XML doesn\'t contain a valid Factur-X version.');
        }

        $documentIdentifier = $documentIdentifierItem->nodeValue;

        if (!is_string($documentIdentifier)) {
            throw new \Exception('The XML doesn\'t contain a valid Factur-X version.');
        }

        $explodedDocumentIdentifier = explode(':', $documentIdentifier);

        $profile = end($explodedDocumentIdentifier);
        if (!$profile) {
            throw new \Exception('The XML doesn\'t contain a valid Factur-X version.');
        }

        if (!array_key_exists(strtolower($profile), \Atgp\FacturX\Facturx::FACTURX_PROFIL_TO_XSD)) {
            $profile = prev($explodedDocumentIdentifier);

            if (!$profile) {
                throw new \Exception('The XML doesn\'t contain a valid Factur-X version.');
            }
        }

        if (!array_key_exists(strtolower($profile), \Atgp\FacturX\Facturx::FACTURX_PROFIL_TO_XSD)) {
            throw new \Exception(sprintf('Invalid Factur-X URN : %s)', $documentIdentifier));
        }

        return $profile;
    }
}
