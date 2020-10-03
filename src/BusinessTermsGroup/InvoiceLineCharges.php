<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-28
 * A group of business terms providing information about charges and taxes other than VAT applicable to
 * the individual Invoice line.
 */
class InvoiceLineCharges
{
    /**
     * BT-141
     * The amount of a charge, without VAT.
     *
     * @var
     */
    private $amount;

    /**
     * BT-142
     * The base amount that may be used, in conjunction with the Invoice line charge percentage,
     * to calculate the Invoice line charge amount.
     *
     * @var
     */
    private $baseAmount;

    /**
     * BT-143
     * The percentage that may be used, in conjunction with the Invoice line charge base amount,
     * to calculate the Invoice line charge amount.
     *
     * @var
     */
    private $percentage;

    /**
     * BT-144
     * The reason for the Invoice line charge, expressed as text.
     *
     * @var string|null
     */
    private $reason;

    /**
     * BT-145
     * The reason for the Invoice line charge, expressed as a code.
     *
     * @var
     */
    private $reasonCode;
}
