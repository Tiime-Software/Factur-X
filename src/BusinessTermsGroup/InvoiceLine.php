<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-25
 * A group of business terms providing information on individual Invoice lines.
 */
class InvoiceLine
{
    /**
     * BT-126
     * A unique identifier for the individual line within the Invoice.
     *
     * @var
     */
    private $identifier;

    /**
     * BT-127
     * A textual note that gives unstructured information that is relevant to the Invoice line.
     *
     * @var
     */
    private $invoiceLineNote;

    /** @todo BT-128 */

    /**
     * BT-129
     * The quantity of items (goods or services) that is charged in the Invoice line.
     *
     * @var
     */
    private $invoicedQuantity;

    /**
     * BT-130
     * The unit of measure that applies to the invoiced quantity.
     *
     * @var
     */
    private $invoicedQuantityUnitOfMeasureCode;

    /**
     * BT-131
     * The total amount of the Invoice line.
     *
     * @var
     */
    private $invoiceLineNetAmount;

    /**
     * BT-132
     * An identifier for a referenced line within a purchase order, issued by the Buyer.
     *
     * @var
     */
    private $referencedPurchaseOrderLineReference;

    /**
     * BT-133
     * A textual value that specifies where to book the relevant data into the Buyer's financial accounts.
     *
     * @var
     */
    private $invoiceLineBuyerAccountingReference;

    public function getXml(): string
    {
        return <<<XML
            <ram:IncludedSupplyChainTradeLineItem>
                <ram:AssociatedDocumentLineDocument>
                    <ram:LineID>$this->identifier</ram:LineID>
                </ram:AssociatedDocumentLineDocument>
                <ram:SpecifiedTradeProduct>
                    <ram:SellerAssignedID>999992</ram:SellerAssignedID>
                    <ram:Name>EM FRITUURVET </ram:Name>
                </ram:SpecifiedTradeProduct>
                <ram:SpecifiedLineTradeAgreement>
                    <ram:NetPriceProductTradePrice>
                        <ram:ChargeAmount>17.02</ram:ChargeAmount>
                    </ram:NetPriceProductTradePrice>
                </ram:SpecifiedLineTradeAgreement>
                <ram:SpecifiedLineTradeDelivery>
                    <ram:BilledQuantity unitCode="$this->invoicedQuantityUnitOfMeasureCode">
                        $this->invoicedQuantity
                    </ram:BilledQuantity>
                </ram:SpecifiedLineTradeDelivery>
                <ram:SpecifiedLineTradeSettlement>
                    <ram:ApplicableTradeTax>
                        <ram:TypeCode>VAT</ram:TypeCode>
                        <ram:CategoryCode>S</ram:CategoryCode>
                        <ram:RateApplicablePercent>6</ram:RateApplicablePercent>
                    </ram:ApplicableTradeTax>
                    <ram:SpecifiedTradeSettlementLineMonetarySummation>
                        <ram:LineTotalAmount>$this->invoiceLineNetAmount * $this->invoicedQuantity</ram:LineTotalAmount>
                    </ram:SpecifiedTradeSettlementLineMonetarySummation>
                </ram:SpecifiedLineTradeSettlement>
            </ram:IncludedSupplyChainTradeLineItem>
        XML;
    }
}
