<?php

namespace Tiime\FacturX;

use Alcohol\ISO4217;
use Tiime\FacturX\BusinessTermsGroup\AdditionalSupportingDocuments;
use Tiime\FacturX\BusinessTermsGroup\Buyer;
use Tiime\FacturX\BusinessTermsGroup\DeliveryInformation;
use Tiime\FacturX\BusinessTermsGroup\DocumentLevelAllowances;
use Tiime\FacturX\BusinessTermsGroup\DocumentLevelCharges;
use Tiime\FacturX\BusinessTermsGroup\DocumentTotals;
use Tiime\FacturX\BusinessTermsGroup\InvoiceLine;
use Tiime\FacturX\BusinessTermsGroup\InvoiceNote;
use Tiime\FacturX\BusinessTermsGroup\Payee;
use Tiime\FacturX\BusinessTermsGroup\PaymentInstructions;
use Tiime\FacturX\BusinessTermsGroup\PrecedingInvoiceReference;
use Tiime\FacturX\BusinessTermsGroup\ProcessControl;
use Tiime\FacturX\BusinessTermsGroup\Seller;
use Tiime\FacturX\BusinessTermsGroup\SellerTaxRepresentativeParty;
use Tiime\FacturX\BusinessTermsGroup\VatBreakdown;

class Invoice
{
    const TYPE_DEBIT_NOTE_RELATED_TO_GOODS_OR_SERVICES = '80';
    const TYPE_CREDIT_NOTE_RELATED_TO_GOODS_OR_SERVICES = '81';
    const TYPE_METERED_SERVICES_INVOICE = '82';
    const TYPE_CREDIT_NOTE_RELATED_TO_FINANCIAL_ADJUSTMENTS = '83';
    const TYPE_DEBIT_NOTE_RELATED_TO_FINANCIAL_ADJUSTMENTS = '84';
    const TYPE_INVOICING_DATA_SHEET = '130';
    const TYPE_DIRECT_PAYMENT_VALUATION = '202';
    const TYPE_PROVISIONAL_PAYMENT_VALUATION = '203';
    const TYPE_PAYMENT_VALUATION = '204';
    const TYPE_INTERIM_APPLICATION_FOR_PAYMENT = '211';
    const TYPE_SELF_BILLED_CREDIT_NOTE = '261';
    const TYPE_CONSOLIDATED_CREDIT_NOTE_GOODS_AND_SERVICES = '262';
    const TYPE_PRICE_VARIATION_INVOICE = '295';
    const TYPE_CREDIT_NOTE_FOR_PRICE_VARIATION = '296';
    const TYPE_DELCREDERE_CREDIT_NOTE = '308';
    const TYPE_PROFORMA_INVOICE = '325';
    const TYPE_PARTIAL_INVOICE = '326';
    const TYPE_COMMERCIAL_INVOICE = '380';
    const TYPE_CREDIT_NOTE = '381';
    const TYPE_DEBIT_NOTE = '383';
    const TYPE_CORRECTED_INVOICE = '384';
    const TYPE_CONSOLIDATED_INVOICE = '385';
    const TYPE_PREPAYMENT_INVOICE = '386';
    const TYPE_HIRE_INVOICE = '387';
    const TYPE_TAX_INVOICE = '388';
    const TYPE_SELF_BILLED_INVOICE = '389';
    const TYPE_DELCREDERE_INVOICE = '390';
    const TYPE_FACTORED_INVOICE = '393';
    const TYPE_LEASE_INVOICE = '394';
    const TYPE_CONSIGNMENT_INVOICE = '395';
    const TYPE_FACTORED_CREDIT_NOTE = '396';
    const TYPE_OCR_PAYMENT_CREDIT_NOTE = '420';
    const TYPE_DEBIT_ADVICE = '456';
    const TYPE_REVERSAL_OF_DEBIT = '457';
    const TYPE_REVERSAL_OF_CREDIT = '458';
    const TYPE_SELF_BILLED_DEBIT_NOTE = '527';
    const TYPE_FORWARDER_CREDIT_NOTE = '532';
    const TYPE_INSURER_INVOICE = '575';
    const TYPE_FORWARDER_INVOICE = '623';
    const TYPE_PORT_CHARGES_DOCUMENTS = '633';
    const TYPE_INVOICE_INFORMATION_FOR_ACCOUNTING_PURPOSES = '751';
    const TYPE_FREIGHT_INVOICE = '780';
    const TYPE_CUSTOMS_INVOICE = '935';

    /**
     * BT-1
     * A unique identification of the Invoice.
     *
     * @var string
     */
    private $number;

    /**
     * BT-2
     * The date when the Invoice was issued.
     *
     * @var \DateTimeInterface
     */
    private $issueDate;

    /**
     * BT-3
     * A code specifying the functional type of the Invoice.
     *
     * @var
     */
    private $typeCode;

    /**
     * BT-5
     * The currency in which all Invoice amounts are given, except for the Total VAT amount in accounting currency.
     *
     * @var string
     */
    private $currencyCode;

    /**
     * BT-6
     * The currency used for VAT accounting and reporting purposes as accepted or required in the country of the Seller.
     *
     * @var
     */
    private $vatAccountingCurrencyCode;

    /**
     * BT-7
     * The date when the VAT becomes accountable for the Seller and for the Buyer in so far as
     * that date can be determined and differs from the date of issue of the invoice, according to the VAT directive.
     *
     * @var \DateTimeInterface|null
     */
    private $valueAddedTaxPointDate;

    /**
     * BT-8
     * The code of the date when the VAT becomes accountable for the Seller and for the Buyer.
     *
     * @var
     */
    private $valueAddedTaxPointDateCode;

    /**
     * BT-9
     * The date when the payment is due.
     *
     * @var \DateTimeInterface|null
     */
    private $paymentDueDate;

    /**
     * BT-10
     * An identifier assigned by the Buyer used for internal routing purposes.
     *
     * @var
     */
    private $buyerReference;

    /**
     * BT-11
     * The identification of the project the invoice refers to.
     *
     * @var
     */
    private $projectReference;

    /**
     * BT-12
     * The identification of a contract.
     *
     * @var
     */
    private $contractReference;

    /**
     * BT-13
     * An identifier of a referenced purchase order, issued by the Buyer.
     *
     * @var
     */
    private $purchaseOrderReference;

    /**
     * BT-14
     * An identifier of a referenced sales order, issued by the Seller.
     *
     * @var
     */
    private $salesOrderReference;

    /**
     * BT-15
     * An identifier of a referenced receiving advice.
     *
     * @var
     */
    private $receivingAdviceReference;

    /**
     * BT-16
     * An identifier of a referenced despatch advice.
     *
     * @var
     */
    private $despatchAdviceReference;

    /**
     * BT-17
     * The identification of the call for tender or lot the invoice relates to.
     *
     * @var
     */
    private $tenderOrLotReference;

    /** @todo BT18 */

    /**
     * BT-19
     * A textual value that specifies where to book the relevant data into the Buyer's financial accounts.
     *
     * @var string|null
     */
    private $buyerAccountingReference;

    /**
     * BT-20
     * A textual description of the payment terms that apply to
     * the amount due for payment (Including description of possible penalties).
     *
     * @var string|null
     */
    private $paymentTerms;

    /**
     * @var InvoiceNote[]
     */
    private $invoiceNote;

    /**
     * @var ProcessControl
     */
    private $processControl;

    /**
     * @var PrecedingInvoiceReference[]
     */
    private $precedingInvoiceReference;

    /**
     * @var Seller
     */
    private $seller;

    /**
     * @var Buyer
     */
    private $buyer;

    /**
     * @var Payee|null
     */
    private $payee;

    /**
     * @var SellerTaxRepresentativeParty|null
     */
    private $sellerTaxRepresentativeParty;

    /**
     * @var DeliveryInformation|null
     */
    private $deliveryInformation;

    /**
     * @var PaymentInstructions|null
     */
    private $paymentInstructions;

    /**
     * @var DocumentLevelAllowances[]
     */
    private $documentLevelAllowances;

    /**
     * @var DocumentLevelCharges[]
     */
    private $documentLevelCharges;

    /**
     * @var DocumentTotals
     */
    private $documentTotals;

    /**
     * @var VatBreakdown[]
     */
    private $vatBreakdowns;

    /**
     * @var AdditionalSupportingDocuments[]
     */
    private $additionalSupportingDocuments;

    /**
     * @var InvoiceLine[]
     */
    private $invoiceLines;

    public function __construct(
        string $number,
        \DateTimeInterface $issueDate,
        string $typeCode,
        string $currencyCode,
        ProcessControl $processControl,
        Seller $seller,
        Buyer $buyer,
        DocumentTotals $documentTotals,
        array $vatBreakdowns,
        array $invoiceLines
    ) {
        $this->vatBreakdowns = [];
        foreach ($vatBreakdowns as $vatBreakdown) {
            if ($vatBreakdown instanceof VatBreakdown) {
                $this->vatBreakdowns[] = $vatBreakdown;
            }
        }

        if (empty($this->vatBreakdowns)) {
            /** @todo Exception */
        }

        $this->invoiceLines = [];
        foreach ($invoiceLines as $invoiceLine) {
            if ($invoiceLine instanceof InvoiceLine) {
                $this->invoiceLines[] = $invoiceLine;
            }
        }

        if (empty($this->invoiceLines)) {
            /** @todo Exception */
        }

        (new ISO4217())->getByCode($currencyCode);

        $this->number = $number;
        $this->issueDate = $issueDate;
        $this->typeCode = $typeCode;
        $this->invoiceNote = [];
        $this->currencyCode = $currencyCode;
        $this->processControl = $processControl;
        $this->seller = $seller;
        $this->buyer = $buyer;
        $this->documentTotals = $documentTotals;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getIssueDate(): \DateTimeInterface
    {
        return $this->issueDate;
    }

    public function getTypeCode()
    {
        return $this->typeCode;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function getVatAccountingCurrencyCode()
    {
        return $this->vatAccountingCurrencyCode;
    }

    public function getValueAddedTaxPointDate(): \DateTimeInterface
    {
        return $this->valueAddedTaxPointDate;
    }

    public function getValueAddedTaxPointDateCode()
    {
        return $this->valueAddedTaxPointDateCode;
    }

    public function getPaymentDueDate(): \DateTimeInterface
    {
        return $this->paymentDueDate;
    }

    public function getBuyerReference()
    {
        return $this->buyerReference;
    }

    public function getProjectReference()
    {
        return $this->projectReference;
    }

    public function getContractReference()
    {
        return $this->contractReference;
    }

    public function getPurchaseOrderReference()
    {
        return $this->purchaseOrderReference;
    }

    public function getSalesOrderReference()
    {
        return $this->salesOrderReference;
    }

    public function getReceivingAdviceReference()
    {
        return $this->receivingAdviceReference;
    }

    public function getDespatchAdviceReference()
    {
        return $this->despatchAdviceReference;
    }

    public function getTenderOrLotReference()
    {
        return $this->tenderOrLotReference;
    }

    public function getBuyerAccountingReference(): string
    {
        return $this->buyerAccountingReference;
    }

    public function getPaymentTerms(): string
    {
        return $this->paymentTerms;
    }

    public function getInvoiceNote(): array
    {
        return $this->invoiceNote;
    }

    public function getProcessControl(): ProcessControl
    {
        return $this->processControl;
    }

    public function getPrecedingInvoiceReference(): array
    {
        return $this->precedingInvoiceReference;
    }

    public function getSeller(): Seller
    {
        return $this->seller;
    }

    public function getBuyer(): Buyer
    {
        return $this->buyer;
    }

    public function getPayee(): Payee
    {
        return $this->payee;
    }

    public function getSellerTaxRepresentativeParty(): SellerTaxRepresentativeParty
    {
        return $this->sellerTaxRepresentativeParty;
    }

    public function getDeliveryInformation(): DeliveryInformation
    {
        return $this->deliveryInformation;
    }

    public function getPaymentInstructions(): PaymentInstructions
    {
        return $this->paymentInstructions;
    }

    public function getDocumentLevelAllowances(): array
    {
        return $this->documentLevelAllowances;
    }

    public function getDocumentLevelCharges(): array
    {
        return $this->documentLevelCharges;
    }

    public function getDocumentTotals(): DocumentTotals
    {
        return $this->documentTotals;
    }

    public function getVatBreakdowns(): array
    {
        return $this->vatBreakdowns;
    }

    public function getAdditionalSupportingDocuments(): array
    {
        return $this->additionalSupportingDocuments;
    }

    public function getInvoiceLines(): array
    {
        return $this->invoiceLines;
    }
}
