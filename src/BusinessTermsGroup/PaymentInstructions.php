<?php

namespace Tiime\FacturX\BusinessTermsGroup;

use Tiime\FacturX\DataType\PaymentMeansCode;

/**
 * BG-16
 * A group of business terms providing information about the payment.
 */
class PaymentInstructions
{
    /**
     * BT-81
     * The means, expressed as code, for how a payment is expected to be or has been settled.
     */
    private PaymentMeansCode $paymentMeansTypeCode;

    /**
     * BT-82
     * The means, expressed as text, for how a payment is expected to be or has been settled.
     */
    private ?string $paymentMeansText;

    /**
     * BT-83
     * A textual value used to establish a link between the payment and the Invoice, issued by the Seller.
     */
    private ?string $remittanceInformation;

    /**
     * @var array<int, CreditTransfer>
     */
    private array $creditTransfers;

    private ?PaymentCardInformation $paymentCardInformation;

    private ?DirectDebit $directDebit;

    public function hydrateXmlDocument(\DOMDocument $document): void
    {
    }
}
