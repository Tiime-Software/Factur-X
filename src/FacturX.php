<?php

declare(strict_types=1);

namespace Tiime\FacturX;

class FacturX
{
    private string $pdfContent;

    private ?string $xmlContent;

    private \Atgp\FacturX\Facturx $facturxManager;

    public function __construct(string $pdfContent, ?string $xmlContent = null)
    {
        $this->facturxManager = new \Atgp\FacturX\Facturx();

        if (
            $this->facturxManager->getFacturxXmlFromPdf($pdfContent) === false
            && ($xmlContent === null || !$this->facturxManager->checkFacturxXsd($xmlContent))
        ) {
            throw new \Exception('FacturX must contain a PDF with a valid XML or be created with an XML to be inserted in the PDF.');
        }

        $this->pdfContent = $pdfContent;
        $this->xmlContent = $xmlContent;
    }

    public function getXmlContent(): string
    {
        return $this->xmlContent;
    }

    public function getPdfContent(): string
    {
        return $this->pdfContent;
    }

    public function generate(array $additionalAttachments = [], bool $addFacturxLogo = true): string {
        if (!is_string($this->xmlContent)) {
            throw new \Exception('You have not provided any XML content so you cannot change your initial PDF file.');
        }

        return $this->facturxManager->generateFacturxFromFiles(
            $this->pdfContent,
            $this->xmlContent,
            additionalAttachments: $additionalAttachments,
            addFacturxLogo: $addFacturxLogo
        );
    }

    public function extractXmlFromPdf(): string
    {
        $extractedXml = $this->facturxManager->getFacturxXmlFromPdf($this->pdfContent);
        if ($extractedXml === false) {
            throw new \Exception('The PDF content you provided does not contain valid XML so you cannot extract it.');
        }

        return $extractedXml;
    }
}
