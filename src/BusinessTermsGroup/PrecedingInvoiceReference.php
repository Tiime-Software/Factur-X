<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-3
 * A group of business terms providing information on one or more preceding Invoices.
 */
class PrecedingInvoiceReference
{
    /**
     * BT-25
     * The identification of an Invoice that was previously sent by the Seller.
     *
     * @var
     */
    private $reference;

    /**
     * BT-26
     * The date when the Preceding Invoice was issued.
     *
     * @var \DateTimeInterface|null
     */
    private $issueDate;
}
