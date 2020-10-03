<?php

namespace Tiime\FacturX\BusinessTermsGroup;

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
     * @var
     */
    private $itemNetPrice;

    /**
     * BT-147
     * The total discount subtracted from the Item gross price to calculate the Item net price.
     *
     * @var
     */
    private $itemPriceDiscount;

    /**
     * BT-148
     * The unit price, exclusive of VAT, before subtracting Item price discount.
     *
     * @var
     */
    private $itemGrossPrice;

    /**
     * BT-149
     * The number of item units to which the price applies.
     *
     * @var
     */
    private $itemPriceBaseQuantity;

    /**
     * BT-150
     * The Item price base quantity unit of measure shall be the same as the Invoiced quantity unit of measure (BT-130).
     *
     * @var
     */
    private $itemPriceBaseQuantityUnitOfMeasureCode;
}
