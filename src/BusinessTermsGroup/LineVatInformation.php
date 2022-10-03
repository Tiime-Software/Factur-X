<?php

namespace Tiime\FacturX\BusinessTermsGroup;

use Tiime\FacturX\DataType\VatCategory;

/**
 * BG-50
 * A group of business terms providing information about the VAT applicable for
 * the goods and services invoiced on the Invoice line.
 */
class LineVatInformation
{
    /**
     * BT-151
     * The VAT category code for the invoiced item.
     *
     * Code de type de TVA applicable à l'article facturé.
     */
    private VatCategory $invoicedItemVatCategoryCode;

    /**
     * BT-152
     * The VAT rate, represented as percentage that applies to the invoiced item.
     */
    private ?float $invoicedItemVatRate;

    public function __construct(VatCategory $invoicedItemVatCategoryCode)
    {
        $this->invoicedItemVatCategoryCode = $invoicedItemVatCategoryCode;
    }

    public function getInvoicedItemVatRate(): ?float
    {
        return $this->invoicedItemVatRate;
    }

    public function setInvoicedItemVatRate(?float $invoicedItemVatRate): self
    {
        $this->invoicedItemVatRate = $invoicedItemVatRate;

        return $this;
    }

    public function hydrateXmlLine(\DOMDocument $document, \DOMElement $line): void
    {
        $applicableTradeTax = $document->createElement('ram:ApplicableTradeTax');

        $applicableTradeTax->appendChild($document->createElement('ram:TypeCode', "VAT"));
        $applicableTradeTax->appendChild(
            $document->createElement('ram:CategoryCode', $this->invoicedItemVatCategoryCode->value)
        );
        $applicableTradeTax->appendChild($document->createElement('ram:RateApplicablePercent', $this->invoicedItemVatRate));

        $line->appendChild($applicableTradeTax);
    }
}
