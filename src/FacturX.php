<?php

declare(strict_types=1);

namespace Tiime\FacturX;

class FacturX
{
    private \Atgp\FacturX\Facturx $instanceFacturxLibrary;

    public function __construct()
    {
        $this->instanceFacturxLibrary = new \Atgp\FacturX\Facturx();
    }

    /**
     * Generate Factur-X PDF from PDF invoice and Factur-X XML.
     *
     * @param string $pdfInvoiceContent Content of the PDF invoice
     * @param string $xmlInvoiceContent Content of the XML invoice
     * @param array<int, string> $additionalAttachments Content of the additional files
     * @param bool $addFacturxLogo Add Factur-X logo on PDF first page
     *
     * @return string
     * @throws \Exception
     */
    public function generateFromPdfInvoiceContent(
        string $pdfInvoiceContent,
        string $xmlInvoiceContent,
        array $additionalAttachments = [],
        bool $addFacturxLogo = false
    ): string {
        return $this->instanceFacturxLibrary->generateFacturxFromFiles(
            $pdfInvoiceContent,
            $xmlInvoiceContent,
            additionalAttachments: $additionalAttachments,
            addFacturxLogo: $addFacturxLogo
        );
    }

    /**
     * Get Factur-X XML from Factur-X PDF.
     *
     * @param string $pdfInvoiceContent Content of the PDF invoice
     *
     * @return string|bool
     * @throws \Exception
     */
    public function getXmlFromPdfInvoiceContent(string $pdfInvoiceContent): string|bool
    {
        return $this->instanceFacturxLibrary->getFacturxXmlFromPdf($pdfInvoiceContent);
    }

    /**
     * Check Factur-X XML against XSD.
     *
     * @param string $xmlInvoiceContent Content of the XML invoice
     * @param string $profile Possible values : autodetect, minimum, basicwl, basic, en16931
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function checkXsdFromXmlInvoiceContent(string $xmlInvoiceContent, string $profile = 'autodetect'): bool
    {
        return $this->instanceFacturxLibrary->checkFacturxXsd($xmlInvoiceContent, $profile);
    }
}
