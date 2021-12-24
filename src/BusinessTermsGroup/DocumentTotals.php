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
     */
    private float $sumOfInvoiceLineNetAmount;

    /**
     * BT-107
     * Sum of all allowances on document level in the Invoice.
     */
    private ?float $sumOfAllowancesOnDocumentLevel;

    /**
     * BT-108
     * Sum of all charges on document level in the Invoice.
     */
    private ?float $sumOfChargesOnDocumentLevel;

    /**
     * BT-109
     * The total amount of the Invoice without VAT.
     */
    private float $invoiceTotalAmountWithoutVat;

    /**
     * BT-110
     * The total VAT amount for the Invoice.
     */
    private ?float $invoiceTotalVatAmount;

    /**
     * BT-111
     * The VAT total amount expressed in the accounting currency accepted or required in the country of the Seller.
     */
    private ?float $invoiceTotalVatAmountInAccountingCurrency;

    /**
     * BT-112
     * The total amount of the Invoice with VAT.
     */
    private float $invoiceTotalAmountWithVat;

    /**
     * BT-113
     * The sum of amounts which have been paid in advance.
     */
    private ?float $paidAmount;

    /**
     * BT-114
     * The amount to be added to the invoice total to round the amount to be paid.
     */
    private ?float $roundingAmount;

    /**
     * BT-115
     * The outstanding amount that is requested to be paid.
     */
    private float $amountDueForPayment;

    public function __construct(
        float $sumOfInvoiceLineNetAmount,
        float $invoiceTotalAmountWithoutVat,
        float $invoiceTotalAmountWithVat,
        float $amountDueForPayment
    ) {
        $this->sumOfInvoiceLineNetAmount = $sumOfInvoiceLineNetAmount;
        $this->invoiceTotalAmountWithoutVat = $invoiceTotalAmountWithoutVat;
        $this->invoiceTotalAmountWithVat = $invoiceTotalAmountWithVat;
        $this->amountDueForPayment = $amountDueForPayment;

        $this->invoiceTotalVatAmount = null;
    }

    public function setSumOfAllowancesOnDocumentLevel(?float $sumOfAllowancesOnDocumentLevel): void
    {
        $this->sumOfAllowancesOnDocumentLevel = $sumOfAllowancesOnDocumentLevel;
    }

    public function setSumOfChargesOnDocumentLevel(?float $sumOfChargesOnDocumentLevel): void
    {
        $this->sumOfChargesOnDocumentLevel = $sumOfChargesOnDocumentLevel;
    }

    public function setInvoiceTotalVatAmount(?float $invoiceTotalVatAmount): void
    {
        $this->invoiceTotalVatAmount = $invoiceTotalVatAmount;
    }

    public function setInvoiceTotalVatAmountInAccountingCurrency(
        ?float $invoiceTotalVatAmountInAccountingCurrency
    ): void {
        $this->invoiceTotalVatAmountInAccountingCurrency = $invoiceTotalVatAmountInAccountingCurrency;
    }

    public function setPaidAmount(?float $paidAmount): void
    {
        $this->paidAmount = $paidAmount;
    }

    public function setRoundingAmount(?float $roundingAmount): void
    {
        $this->roundingAmount = $roundingAmount;
    }

    public function getSumOfInvoiceLineNetAmount(): float
    {
        return $this->sumOfInvoiceLineNetAmount;
    }

    public function getSumOfAllowancesOnDocumentLevel(): ?float
    {
        return $this->sumOfAllowancesOnDocumentLevel;
    }

    public function getSumOfChargesOnDocumentLevel(): ?float
    {
        return $this->sumOfChargesOnDocumentLevel;
    }

    public function getInvoiceTotalAmountWithoutVat(): float
    {
        return $this->invoiceTotalAmountWithoutVat;
    }

    public function getInvoiceTotalVatAmount(): ?float
    {
        return $this->invoiceTotalVatAmount;
    }

    public function getInvoiceTotalVatAmountInAccountingCurrency(): ?float
    {
        return $this->invoiceTotalVatAmountInAccountingCurrency;
    }

    public function getInvoiceTotalAmountWithVat(): float
    {
        return $this->invoiceTotalAmountWithVat;
    }

    public function getPaidAmount(): ?float
    {
        return $this->paidAmount;
    }

    public function getRoundingAmount(): ?float
    {
        return $this->roundingAmount;
    }

    public function getAmountDueForPayment(): float
    {
        return $this->amountDueForPayment;
    }

    public function hydrateXmlDocument(\DOMDocument $document, string $profil): void
    {
        $applicableHeaderTradeSettlement = $document
            ->getElementsByTagName('ram:ApplicableHeaderTradeSettlement')
            ->item(0);

        $specifiedTradeSettlementHeaderMonetarySummation = $document->createElement(
            'ram:SpecifiedTradeSettlementHeaderMonetarySummation'
        );

        if (ProcessControl::MINIMUM !== $profil) {
            $specifiedTradeSettlementHeaderMonetarySummation->appendChild(
                $document->createElement('ram:LineTotalAmount', $this->sumOfInvoiceLineNetAmount)
            );
        }

        $specifiedTradeSettlementHeaderMonetarySummation->appendChild(
            $document->createElement('ram:TaxBasisTotalAmount', $this->invoiceTotalAmountWithoutVat)
        );

        if (null !== $this->invoiceTotalVatAmount) {
            $specifiedTradeSettlementHeaderMonetarySummation->appendChild(
                $document->createElement('ram:TaxTotalAmount', $this->invoiceTotalVatAmount)
            );
        }

        $specifiedTradeSettlementHeaderMonetarySummation->appendChild(
            $document->createElement('ram:GrandTotalAmount', $this->invoiceTotalAmountWithVat)
        );
        $specifiedTradeSettlementHeaderMonetarySummation->appendChild(
            $document->createElement('ram:DuePayableAmount', $this->amountDueForPayment)
        );

        $applicableHeaderTradeSettlement->appendChild($specifiedTradeSettlementHeaderMonetarySummation);
    }
}
