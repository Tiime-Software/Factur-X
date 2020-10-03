<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-27
 * A group of business terms providing information about allowances applicable to the individual Invoice line.
 */
class InvoiceLineAllowances
{
    /**
     * BT-136
     * The amount of an allowance, without VAT.
     * @var
     */
    private $amount;

    /**
     * BT-137
     * The base amount that may be used, in conjunction with the Invoice line allowance percentage,
     * to calculate the Invoice line allowance amount.
     *
     * @var
     */
    private $baseAmount;

    /**
     * BT-138
     * The percentage that may be used, in conjunction with the Invoice line allowance base amount,
     * to calculate the Invoice line allowance amount.
     *
     * @var
     */
    private $percentage;

    /**
     * BT-139
     * The reason for the Invoice line allowance, expressed as text.
     *
     * @var string|null
     */
    private $reason;

    /**
     * BT-140
     * The reason for the Invoice line allowance, expressed as a code.
     *
     * @var
     */
    private $reasonCode;
}
