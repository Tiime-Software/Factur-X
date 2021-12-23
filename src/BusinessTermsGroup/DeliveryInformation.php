<?php

namespace Tiime\FacturX\BusinessTermsGroup;

use Tiime\FacturX\DataType\Identifier;

/**
 * BG-13
 * A group of business terms providing information about where and when the goods and services invoiced are delivered.
 */
class DeliveryInformation
{
    /**
     * BT-70
     * The name of the party to which the goods and services are delivered.
     *
     * @var
     */
    private $deliverToPartyName;

    /**
     * @todo BT-71
     *
     * @var Identifier[]
     */
    private array $etablissement;

    /**
     * BT-72
     * the date on which the supply of goods or services was made or completed.
     *
     * @var \DateTimeInterface|null
     */
    private $actualDeliveryDate;

    private DeliverToAddress $deliverToAddress;

    private InvoicingPeriod $invoicingPeriod;

    public function hydrateXmlDocument(\DOMDocument $document): void
    {
    }
}
