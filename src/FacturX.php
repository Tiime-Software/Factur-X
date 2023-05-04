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

        $pdfContainsValidXml = true;
        try {
            $this->facturxManager->getFacturxXmlFromPdf($pdfContent);
        } catch (\Exception $e) {
            $pdfContainsValidXml = false;
        }

        if ($xmlContent !== null) {
            $isValidXml = true;

            try {
                $this->facturxManager->checkFacturxXsd($xmlContent);
            } catch (\Exception $e) {
                $isValidXml = false;
            }
        } else {
            $isValidXml = false;
        }

        if (!$pdfContainsValidXml || !$isValidXml) {
            throw new \Exception(
                'FacturX must contain a PDF with a valid XML or be created with an XML to be inserted in the PDF.'
            );
        }

        $this->pdfContent = $pdfContent;
        $this->xmlContent = $xmlContent;
    }

    public function getXmlContent(): ?string
    {
        return $this->xmlContent;
    }

    public function getPdfContent(): string
    {
        return $this->pdfContent;
    }

    /**
     * @param array<int, string> $additionalAttachments
     */
    public function generate(array $additionalAttachments = [], bool $addFacturxLogo = true): string
    {
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
        try {
            $extractedXml = $this->facturxManager->getFacturxXmlFromPdf($this->pdfContent);
        } catch (\Exception $e) {
            throw new \Exception(
                'The PDF content you provided does not contain valid XML so you cannot extract it : ' . $e
            );
        }

        return $extractedXml;
    }
}
