<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-4
 * A group of business terms providing information about the Seller.
 */
class Seller
{
    /**
     * BT-27
     * The full formal name by which the Seller is registered in the national registry of legal entities
     * or as a Taxable person or otherwise trades as a person or persons.
     *
     * @var string
     */
    private $name;

    /**
     * BT-28
     * A name by which the Seller is known, other than Seller name (also known as Business name).
     *
     * @var string|null
     */
    private $tradingName;

    /** @todo BT-29 */
    /** @todo BT-30 */

    /**
     * BT-31
     * The Seller's VAT identifier (also known as Seller VAT identification number)
     *
     * @var
     */
    private $vatIdentifier;

    /**
     * BT-32
     * The local identification (defined by the Seller’s address) of the Seller for tax purposes
     * or a reference that enables the Seller to state his registered tax status.
     *
     * @var
     */
    private $taxRegistrationIdentifier;

    /**
     * BT-33
     * Additional legal information relevant for the Seller.
     *
     * @var
     */
    private $additionalLegalInformation;

    /** @todo BT-34 */

    /**
     * @var SellerPostalAddress
     */
    private $address;

    public function __construct(string $name, SellerPostalAddress $address)
    {
        $this->name = $name;
        $this->address = $address;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): SellerPostalAddress
    {
        return $this->address;
    }
}
