<?php

namespace Tiime\FacturX;

use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\Filter\FilterException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\StreamReader;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use setasign\Fpdi\PdfReader\PageBoundaries;
use setasign\Fpdi\PdfReader\PdfReaderException;
use Tiime\EN16931\Codelist\InvoiceTypeCodeUNTDID1001;
use Tiime\EN16931\Helper\InvoiceTypeCodeUNTDID1001Helper;
use Tiime\FacturX\Fdpi\FdpiFacturX;

class Writer
{
    public const array LOGOS = [
        Profile::MINIMUM->value  => 'Factur-x-minimum.png',
        Profile::BASICWL->value  => 'Factur-x-basic-wl.png',
        Profile::BASIC->value    => 'Factur-x-basic.png',
        Profile::EN16931->value  => 'Factur-x-en16931.png',
        Profile::EXTENDED->value => 'Factur-x-extended.png',
    ];

    public const array XMP_CONFORMANCE_LEVELS = [
        Profile::MINIMUM->value  => 'MINIMUM',
        Profile::BASICWL->value  => 'BASIC WL',
        Profile::BASIC->value    => 'BASIC',
        Profile::EN16931->value  => 'EN 16931',
        Profile::EXTENDED->value => 'EXTENDED',
    ];

    protected bool $importExternalLinks;

    public function __construct()
    {
        $this->importExternalLinks = true;
    }

    /**
     * @param FacturXAttachment[] $additionalAttachments
     *
     * @throws CrossReferenceException
     * @throws Exception
     * @throws FilterException
     * @throws PdfParserException
     * @throws PdfReaderException
     * @throws PdfTypeException
     * @throws \DateMalformedStringException
     */
    public function generate(
        string $pdfContent,
        string $xmlContent,
        bool $validateXsd = true,
        array $additionalAttachments = [],
        bool $addLogo = false,
    ): string {
        foreach ($additionalAttachments as $attachment) {
            if (!$attachment instanceof FacturXAttachment) {
                throw new Exception(\sprintf('An additional attachment must be an instance of %s.', FacturXAttachment::class));
            }
        }

        $document = new \DOMDocument();
        $document->loadXML($xmlContent);

        $profile = ProfileExtractor::process($document);

        if ($validateXsd) {
            (new XsdProcessor($profile))->validate($xmlContent);
        }

        $pdfStreamReader = StreamReader::createByString($pdfContent);
        $xmlStreamReader = StreamReader::createByString($xmlContent);

        $xpath = new \DOMXPath($document);

        $dateXpath = $xpath->query('//rsm:ExchangedDocument/ram:IssueDateTime/udt:DateTimeString');
        \assert($dateXpath instanceof \DOMNodeList);
        $dateItem = $dateXpath->item(0);
        \assert($dateItem instanceof \DOMElement);
        \assert(\is_string($dateItem->nodeValue));
        $dateTime = \DateTime::createFromFormat('Ymd', $dateItem->nodeValue);
        \assert($dateTime instanceof \DateTime);
        $dateTime = $dateTime->setTime(0, 0);

        $invoiceIdXpath = $xpath->query('//rsm:ExchangedDocument/ram:ID');
        \assert($invoiceIdXpath instanceof \DOMNodeList);
        $invoiceIdItem = $invoiceIdXpath->item(0);
        \assert($invoiceIdItem instanceof \DOMElement);
        $invoiceId = $invoiceIdItem->nodeValue;
        \assert(\is_string($invoiceId));

        $sellerXpath = $xpath->query('//ram:ApplicableHeaderTradeAgreement/ram:SellerTradeParty/ram:Name');
        \assert($sellerXpath instanceof \DOMNodeList);
        $sellerItem = $sellerXpath->item(0);
        \assert($sellerItem instanceof \DOMElement);
        $seller = $sellerItem->nodeValue;
        \assert(\is_string($seller));

        $documentTypeXpath = $xpath->query('//rsm:ExchangedDocument/ram:TypeCode');
        \assert($documentTypeXpath instanceof \DOMNodeList);
        $documentTypeItem = $documentTypeXpath->item(0);
        \assert($documentTypeItem instanceof \DOMElement);
        $documentType = $documentTypeItem->nodeValue;
        \assert(\is_string($documentType));

        if (InvoiceTypeCodeUNTDID1001Helper::isInvoice(InvoiceTypeCodeUNTDID1001::from($documentType))) {
            $documentTypeName = 'Invoice';
        } else {
            $documentTypeName = 'Refund';
        }

        $now = new \DateTime('now', new \DateTimeZone('UTC'));

        $pdfWriter = new FdpiFacturX(
            xmlSeller: $seller,
            xmlDocumentTypeName: $documentTypeName,
            xmlInvoiceId: $invoiceId,
            xmlDateTime: $now,
            xmlUrn: 'urn:factur-x:pdfa:CrossIndustryDocument:invoice:1p0#',
            xmlDocumentType: 'INVOICE',
            xmlFilename: 'factur-x.xml',
            xmlVersion: '1.0',
            xmlXmpLevel: static::XMP_CONFORMANCE_LEVELS[$profile->value],
            pdfVersion: '1.7',
            binaryData: true
        );

        $pdfWriter->SetTitle(\sprintf('%s : %s %s', $seller, $documentTypeName, $invoiceId));
        $pdfWriter->SetAuthor($seller);
        $pdfWriter->SetSubject(\sprintf('Factur-X %s %s dated %s issued by %s', $documentTypeName, $invoiceId, $dateTime->format('Y-m-d'), $seller));
        $pdfWriter->SetKeywords(\sprintf('%s, Factur-X', $documentTypeName));
        $pdfWriter->SetCreator('Factur-X PHP library by Tiime');
        $pdfWriter->setModifiedDate($now->format('Y-m-d'));
        $pdfWriter->setCreationDate($now->format('Y-m-d'));

        $pageCount = $pdfWriter->setSourceFile($pdfStreamReader);

        for ($i = 1; $i <= $pageCount; ++$i) {
            $tplIdx = $pdfWriter->importPage($i, PageBoundaries::MEDIA_BOX, true, $this->importExternalLinks);
            $pdfWriter->AddPage();
            $pdfWriter->useTemplate($tplIdx, 0, 0, null, null, true);

            // add Factur-X logo only on the first page
            if ($addLogo && 1 === $i) {
                $pdfWriter->Image(
                    file: __DIR__ . '/../img/' . static::LOGOS[$profile->value],
                    x: 197,
                    y: 10,
                    w: 7
                );
            }
        }

        $pdfWriter->attach($xmlStreamReader, 'factur-x.xml', 'Factur-X Invoice', 'Data', 'text#2Fxml');

        foreach ($additionalAttachments as $attachment) {
            $attachmentFilePath = sys_get_temp_dir() . \DIRECTORY_SEPARATOR . uniqid();

            /* Creating tmp file to solve mime_content_type errors */
            file_put_contents($attachmentFilePath, $attachment->content);

            $pdfWriter->attach(
                $attachmentFilePath,
                $attachment->filename,
                $attachment->description
            );
        }

        return $pdfWriter->Output('S');
    }
}
