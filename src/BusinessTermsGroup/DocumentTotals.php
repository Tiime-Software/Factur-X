<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-22
 * A group of business terms providing the monetary totals for the Invoice.
 */
class DocumentTotals
{
    /**
     * BT-106
     * Sum of all Invoice line net amounts in the Invoice.
     *
     * @var
     */
    private $sumOfInvoiceLineNetAmount;

    /**
     * BT-107
     * Sum of all allowances on document level in the Invoice.
     *
     * @var
     */
    private $sumOfAllowancesOnDocumentLevel;

    /**
     * BT-108
     * Sum of all charges on document level in the Invoice.
     *
     * @var
     */
    private $sumOfChargesOnDocumentLevel;

    /**
     * BT-109
     * The total amount of the Invoice without VAT.
     *
     * @var
     */
    private $invoiceTotalAmountWithoutVat;

    /**
     * BT-110
     * The total VAT amount for the Invoice.
     *
     * @var
     */
    private $invoiceTotalVatAmount;

    /**
     * BT-111
     * The VAT total amount expressed in the accounting currency accepted or required in the country of the Seller.
     *
     * @var
     */
    private $invoiceTotalVatAmountInAccountingCurrency;

    /**
     * BT-112
     * The total amount of the Invoice with VAT.
     *
     * @var
     */
    private $invoiceTotalAmountWithVat;

    /**
     * BT-113
     * The sum of amounts which have been paid in advance.
     *
     * @var
     */
    private $paidAmount;

    /**
     * BT-114
     * The amount to be added to the invoice total to round the amount to be paid.
     *
     * @var
     */
    private $roundingAmount;

    /**
     * BT-115
     * The outstanding amount that is requested to be paid.
     *
     * @var
     */
    private $amountDueForPayment;
}
