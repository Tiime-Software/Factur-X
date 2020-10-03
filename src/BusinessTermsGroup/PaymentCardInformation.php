<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-18
 * A group of business terms providing information about card used for payment contemporaneous with invoice issuance.
 */
class PaymentCardInformation
{
    /**
     * BT-87
     * The Primary Account Number (PAN) of the card used for payment.
     *
     * @var
     */
    private $primaryAccountNumber;

    /**
     * BT-88
     * The name of the payment card holder.
     *
     * @var
     */
    private $holderName;
}
