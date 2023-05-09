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

    private bool $xmlExtractedFromPdf;

    /** @var array<int, FacturXAttachment> $attachments */
    private array $attachments;

    private bool $addFacturXLogo;

    private ?string $profile;

    public function __construct(string $pdfContent, ?string $xmlContent = null)
    {
        $xmlExtractedFromPdf = false;

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
                $xmlExtractedFromPdf = true;
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

        $this->pdfContent = $pdfContent;
        $this->xmlContent = $xmlExtractedFromPdf ? $pdfXml : $xmlContent; // @phpstan-ignore-line
        $this->xmlExtractedFromPdf = $xmlExtractedFromPdf;
        $this->addFacturXLogo = false;
        $this->attachments = [];
        $this->profile = null;
    }

    public function getXmlContent(): string
    {
        return $this->xmlContent;
    }

    public function getPdfContent(): string
    {
        $document = new \DOMDocument();
        $document->loadXML($this->xmlContent);

        $pdfStreamReader = StreamReader::createByString($this->pdfContent);

        $pdfWriter = new FdpiFacturx();
        $pageCount = $pdfWriter->setSourceFile($pdfStreamReader);

        for ($i = 1; $i <= $pageCount; ++$i) {
            $tplIdx = $pdfWriter->importPage($i, '/MediaBox');
            $pdfWriter->AddPage();
            $pdfWriter->useTemplate($tplIdx, 0, 0, null, null, true);

            if ($this->addFacturXLogo && 1 === $i) {
                $pdfWriter->Image(
                    sprintf(
                        '%s%s%s',
                        __DIR__,
                        '/../vendor/atgp/factur-x/img/',
                        \Atgp\FacturX\Facturx::FACTURX_LOGO[$this->profile]
                    ),
                    197,
                    2.5,
                    7
                );
            }
        }

        if (!$this->xmlExtractedFromPdf) {
            $pdfWriter->Attach($this->xmlContent, self::FACTURX_FILENAME, 'Factur-X Invoice', 'Data', 'text#2Fxml');
        }

        /** @var FacturXAttachment $attachment */
        foreach ($this->attachments as $attachment) {
            $attachmentFilePath = sprintf("%s/%s", sys_get_temp_dir(), uniqid());

            /* Creating tmp file to solve mime_content_type errors */
            file_put_contents($attachmentFilePath, $attachment->getContent());

            $pdfWriter->Attach(
                $attachmentFilePath,
                $attachment->getFilename(),
                $attachment->getDescription()
            );
        }

        $pdfWriter->OpenAttachmentPane();
        $pdfWriter->SetPDFVersion('1.7', true);
        $pdfWriter = $this->updatePdfMetadata($pdfWriter, $document);

        return $pdfWriter->Output('invoice-facturx-' . date('Ymdhis') . '.pdf', 'S');
    }

    public function addFacturxLogo(): void
    {
        $this->addFacturXLogo = true;
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

            $this->attachments[] = $additionalAttachment;
        }
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

            if (self::FACTURX_FILENAME === $filespecDetails['F']) {
                $facturxFound = true;

                if (
                    !empty($filespecDetails['EF'])
                    && isset($filespecDetails['EF']['F'])
                    && isset($filespecDetails['EF']['F']['Length'])
                ) {
                    // Get file size
                    $facturxLength = $filespecDetails['EF']['F']['Length'];
                }

                break;
            }
        }

        if (true === $facturxFound) {
            $embeddedFiles = $parsedPdf->getObjectsByType('EmbeddedFile');

            foreach ($embeddedFiles as $embeddedFile) {
                $embeddedFileDetails = $embeddedFile->getDetails();

                // Looking for file with same file length as found before, if empty length, take first EmbeddedFile
                if ($embeddedFileDetails['Length'] == $facturxLength || null == $facturxLength) {
                    $extractedXml = $embeddedFile->getContent();
                }
            }
        }

        return $extractedXml;
    }

    private function checkXmlWithXsd(string $xmlContent): bool
    {
        $document = new \DOMDocument();
        $document->loadXML($xmlContent);

        $profile = $this->getXmlProfile($document);

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

        $this->profile = $profile;

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

        $this->profile = $profile;

        return $profile;
    }

    private function updatePdfMetadata(FdpiFacturx $pdfWriter, \DOMDocument $document): FdpiFacturx
    {
        $pdf_metadata_infos = $this->preparePdfMetadata($document);
        $pdfWriter->set_pdf_metadata_infos($pdf_metadata_infos);

        /** @var \SimpleXMLElement $xmp */
        $xmp = simplexml_load_file(sprintf(
            '%s%s%s',
            __DIR__,
            '/../vendor/atgp/factur-x/xmp/',
            \Atgp\FacturX\Facturx::FACTURX_XMP
        ));
        $descriptionElements = $xmp->xpath('rdf:Description');

        if (!$descriptionElements) {
            return $pdfWriter;
        }

        $descriptionFx = $descriptionElements[0];
        $descriptionFx->children('fx', true)->ConformanceLevel =
            strtoupper(\Atgp\FacturX\Facturx::FACTURX_PROFIL_TO_XMP[$this->profile]);
        $pdfWriter->AddMetadataDescriptionNode($descriptionFx->asXML());

        $pdfWriter->AddMetadataDescriptionNode($descriptionElements[1]->asXML());

        $descriptionPdfAid = $descriptionElements[2];
        $pdfWriter->AddMetadataDescriptionNode($descriptionPdfAid->asXML());

        $descriptionDc = $descriptionElements[3];
        $desc_nodes = $descriptionDc->children('dc', true);
        $desc_nodes->title->children('rdf', true)->Alt->li = $pdf_metadata_infos['title'];
        $desc_nodes->creator->children('rdf', true)->Seq->li = $pdf_metadata_infos['author'];
        $desc_nodes->description->children('rdf', true)->Alt->li = $pdf_metadata_infos['subject'];
        $pdfWriter->AddMetadataDescriptionNode($descriptionDc->asXML());

        $descriptionAdobe = $descriptionElements[4];
        $descriptionAdobe->children('pdf', true)->Producer = 'FPDF';
        $pdfWriter->AddMetadataDescriptionNode($descriptionAdobe->asXML());

        $descriptionXmp = $descriptionElements[5];
        $xmp_nodes = $descriptionXmp->children('xmp', true);
        $xmp_nodes->CreatorTool = 'Tiime';
        $xmp_nodes->CreateDate = $pdf_metadata_infos['createdDate'];
        $xmp_nodes->ModifyDate = $pdf_metadata_infos['modifiedDate'];
        $pdfWriter->AddMetadataDescriptionNode($descriptionXmp->asXML());

        return $pdfWriter;
    }

    /**
     * @return array{author: string|null, keywords: string, title: string, subject: string, createdDate: string,
     *     modifiedDate: string}
     */
    protected function preparePdfMetadata(\DOMDocument $document): array
    {
        $invoiceInformations = $this->extractInvoiceInformations($document);

        $strToTimeDate = strtotime($invoiceInformations['date']);
        if (!$strToTimeDate) {
            throw new \Exception('Date is malformed.');
        }

        $dateString = date('Y-m-d', $strToTimeDate);
        $title = sprintf(
            '%s : %s %s',
            $invoiceInformations['seller'],
            $invoiceInformations['docTypeName'],
            $invoiceInformations['invoiceId']
        );
        $subject = sprintf(
            'Factur-X %s %s dated %s issued by %s',
            $invoiceInformations['docTypeName'],
            $invoiceInformations['invoiceId'],
            $dateString,
            $invoiceInformations['seller']
        );

        return [
            'author' => $invoiceInformations['seller'],
            'keywords' => sprintf('%s, Factur-X', $invoiceInformations['docTypeName']),
            'title' => $title,
            'subject' => $subject,
            'createdDate' => $invoiceInformations['date'],
            'modifiedDate' => date('Y-m-d\TH:i:s') . '+00:00',
        ];
    }

    /**
     * @return array{invoiceId: string|null, docTypeName: 'Invoice'|'Refund', seller: string|null, date: string}
     */
    protected function extractInvoiceInformations(\DOMDocument $document): array
    {
        $xpath = new \DOMXpath($document);

        /** @var \DOMNodeList<\DOMDocument> $dateElements */
        $dateElements = $xpath->query('//rsm:ExchangedDocument/ram:IssueDateTime/udt:DateTimeString');
        $dateItem = $dateElements->item(0);

        if (!$dateItem instanceof \DOMDocument) {
            throw new \Exception('DateTimeString element is missing in XML.');
        }

        $date = $dateItem->nodeValue;

        if ($date === null) {
            throw new \Exception('DateTimeString element is missing in XML.');
        }

        $strToTimeDate = strtotime($date);
        if (!$strToTimeDate) {
            throw new \Exception('DateTimeString element is malformed in XML.');
        }

        $dateReformatted = date('Y-m-d\TH:i:s', $strToTimeDate) . '+00:00';

        /** @var \DOMNodeList<\DOMDocument> $invoiceIdentifierElements */
        $invoiceIdentifierElements = $xpath->query('//rsm:ExchangedDocument/ram:ID');
        $invoiceIdentifierItem = $invoiceIdentifierElements->item(0);

        if (!$invoiceIdentifierItem instanceof \DOMDocument) {
            throw new \Exception('Invoice ID element is missing in XML.');
        }

        $invoiceIdentifier = $invoiceIdentifierItem->nodeValue;

        /** @var \DOMNodeList<\DOMDocument> $sellerElements */
        $sellerElements = $xpath->query('//ram:ApplicableHeaderTradeAgreement/ram:SellerTradeParty/ram:Name');
        $sellerItem = $sellerElements->item(0);

        if (!$sellerItem instanceof \DOMDocument) {
            throw new \Exception('TypeCode element is missing in XML.');
        }

        $seller = $sellerItem->nodeValue;

        /** @var \DOMNodeList<\DOMDocument> $docTypeElements */
        $docTypeElements = $xpath->query('//rsm:ExchangedDocument/ram:TypeCode');
        $docTypeItem = $docTypeElements->item(0);

        if (!$docTypeItem instanceof \DOMDocument) {
            throw new \Exception('TypeCode element is missing in XML.');
        }

        $docType = $docTypeItem->nodeValue;

        switch ($docType) {
            case '381':
                $docTypeName = 'Refund';
                break;
            default:
                $docTypeName = 'Invoice';
                break;
        }

        return [
            'invoiceId' => $invoiceIdentifier,
            'docTypeName' => $docTypeName,
            'seller' => $seller,
            'date' => $dateReformatted,
        ];
    }
}
