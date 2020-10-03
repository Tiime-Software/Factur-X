<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-20
 * A group of business terms providing information about allowances applicable to the Invoice as a whole.
 */
class DocumentLevelAllowances
{
    /**
     * BT-92
     * The amount of an allowance, without VAT.
     * @var
     */
    private $amount;

    /**
     * BT-93
     * The base amount that may be used, in conjunction with the document level allowance percentage,
     * to calculate the document level allowance amount.
     *
     * @var
     */
    private $baseAmount;

    /**
     * BT-94
     * The percentage that may be used, in conjunction with the document level allowance base amount,
     * to calculate the document level allowance amount.
     *
     * @var
     */
    private $percentage;

    /**
     * BT-95
     * A coded identification of what VAT category applies to the document level allowance.
     *
     * @var
     */
    private $vatCategoryCode;

    /**
     * BT-96
     * The VAT rate, represented as percentage that applies to the document level allowance.
     *
     * @var
     */
    private $vatRate;

    /**
     * BT-97
     * The reason for the document level allowance, expressed as text.
     *
     * @var string|null
     */
    private $reason;

    /**
     * BT-98
     * The reason for the document level allowance, expressed as a code.
     *
     * @var
     */
    private $reasonCode;
}
