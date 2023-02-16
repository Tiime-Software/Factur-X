<?php

namespace Tiime\FacturX\BusinessTermsGroup;

use Tiime\FacturX\DataType\UnitOfMeasurement;

/**
 * BG-29
 * A group of business terms providing information about the price applied for
 * the goods and services invoiced on the Invoice line.
 */
class PriceDetails
{
    /**
     * BT-146
     * The price of an item, exclusive of VAT, after subtracting item price discount.
     *
     */
    private float $itemNetPrice;

    /**
     * BT-147
     * The total discount subtracted from the Item gross price to calculate the Item net price.
     *
     */
    private ?float $itemPriceDiscount;

    /**
     * BT-148
     * The unit price, exclusive of VAT, before subtracting Item price discount.
     *
     */
    private ?float $itemGrossPrice;

    /**
     * BT-149
     * The number of item units to which the price applies.
     *
     */
    private ?float $itemPriceBaseQuantity;

    /**
     * BT-150
     * The Item price base quantity unit of measure shall be the same as the Invoiced quantity unit of measure (BT-130).
     *
     */
    private ?UnitOfMeasurement $itemPriceBaseQuantityUnitOfMeasureCode;

    public function __construct(float $itemNetPrice)
    {
        $this->itemNetPrice = $itemNetPrice;
    }

    public function hydrateXmlLine(\DOMDocument $document, \DOMElement $line): void
    {
        $specifiedLineTradeAgreement = $document->createElement('ram:SpecifiedLineTradeAgreement');

        $netPriceProductTradePrice = $document->createElement('ram:NetPriceProductTradePrice');
        $netPriceProductTradePrice->appendChild(
            $document->createElement('ram:ChargeAmount', (string) $this->itemNetPrice)
        );

        $specifiedLineTradeAgreement->appendChild($netPriceProductTradePrice);
        $line->appendChild($specifiedLineTradeAgreement);
    }
}
