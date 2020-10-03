<?php

namespace Tiime\FacturX\BusinessTermsGroup;

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
     * @var
     */
    private $invoicedItemVatCategoryCode;

    /**
     * BT-152
     * The VAT rate, represented as percentage that applies to the invoiced item.
     *
     * @var
     */
    private $invoicedItemVatRate;
}
