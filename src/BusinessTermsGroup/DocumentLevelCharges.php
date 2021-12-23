<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-21
 * A group of business terms providing information about charges and taxes other than VAT,
 * applicable to the Invoice as a whole.
 */
class DocumentLevelCharges
{
    /**
     * BT-99
     * The amount of a charge, without VAT.
     *
     * @var
     */
    private $amount;

    /**
     * BT-100
     * The base amount that may be used, in conjunction with the document level charge percentage,
     * to calculate the document level charge amount.
     *
     * @var
     */
    private $baseAmount;

    /**
     * BT-101
     * The percentage that may be used, in conjunction with the document level charge base amount,
     * to calculate the document level charge amount.
     *
     * @var
     */
    private $percentage;

    /**
     * BT-102
     * A coded identification of what VAT category applies to the document level charge.
     *
     * @var
     */
    private $vatCategoryCode;

    /**
     * BT-103
     * The VAT rate, represented as percentage that applies to the document level charge.
     *
     * @var
     */
    private $vatRate;

    /**
     * BT-104
     * The reason for the document level charge, expressed as text.
     *
     * @var string|null
     */
    private $reason;

    /**
     * BT-105
     * The reason for the document level charge, expressed as a code.
     *
     * @var
     */
    private $reasonCode;
}
