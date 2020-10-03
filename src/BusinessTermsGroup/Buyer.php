<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-7
 * A group of business terms providing information about the Buyer.
 */
class Buyer
{
    /**
     * BT-44
     * The full name of the Buyer.
     *
     * @var string
     */
    private $name;

    /**
     * BT-45
     * A name by which the Buyer is known, other than Buyer name (also known as Business name).
     *
     * @var string|null
     */
    private $tradingName;

    /** @todo BT-46 */
    /** @todo BT-47 */

    /**
     * BT-48
     * The Buyer's VAT identifier (also known as Buyer VAT identification number).
     *
     * @var string|null
     */
    private $vatIdentifier;

    /**
     * BG-8
     *
     *
     * @var BuyerPostalAddress
     */
    private $address;

    /**
     * BG-9
     *
     * @var BuyerContact|null
     */
    private $contact;

    /** @todo BT-49 */

    public function __construct(string $name, BuyerPostalAddress $address)
    {
        $this->name = $name;
        $this->address = $address;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): BuyerPostalAddress
    {
        return $this->address;
    }
}
