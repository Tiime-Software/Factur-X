<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-17
 * A group of business terms to specify credit transfer payments.
 */
class CreditTransfer
{
    /**
     * BT-84
     * A unique identifier of the financial payment account, at a payment service provider, to which payment should be made.
     *
     * @var
     */
    private $paymentAccountIdentifier;

    /**
     * BT-85
     * The name of the payment account, at a payment service provider, to which payment should be made.
     *
     * @var
     */
    private $paymentAccountName;

    /**
     * BT-86
     * An identifier for the payment service provider where a payment account is located.
     *
     * @var
     */
    private $paymentServiceProviderIdentifier;
}
