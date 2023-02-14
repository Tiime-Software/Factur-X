<?php

namespace Tiime\FacturX\BusinessTermsGroup;

use Tiime\FacturX\DataType\Reference\PrecedingInvoiceReference;

/**
 * BG-3
 * A group of business terms providing information on one or more preceding Invoices.
 */
class PrecedingInvoice
{
    /**
     * BT-25
     * The identification of an Invoice that was previously sent by the Seller.
     */
    private PrecedingInvoiceReference $reference;

    /**
     * BT-26
     * The date when the Preceding Invoice was issued.
     */
    private ?\DateTimeInterface $issueDate;
}
