<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-19
 * A group of business terms to specify a direct debit.
 */
class DirectDebit
{
    /**
     * BT-89
     * Unique identifier assigned by the Payee for referencing the direct debit mandate.
     *
     * @var
     */
    private $mandateReferenceIdentifier;

    /**
     * BT-90
     * Unique banking reference identifier of the Payee or Seller assigned by the Payee or Seller bank.
     *
     * @var
     */
    private $bankAssignedCreditorIdentifier;

    /**
     * BT-91
     * The account to be debited by the direct debit.
     *
     * @var
     */
    private $debitedAccountIdentifier;
}
