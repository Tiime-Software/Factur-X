<?php

namespace Tiime\FacturX\BusinessTermsGroup;

use Tiime\FacturX\DataType\Identifier;
use Tiime\FacturX\DataType\Identifier\ElectronicAddressIdentifier;
use Tiime\FacturX\DataType\Identifier\LegalRegistrationIdentifier;
use Tiime\FacturX\DataType\Identifier\SellerIdentifier;
use Tiime\FacturX\DataType\Identifier\TaxRegistrationIdentifier;
use Tiime\FacturX\DataType\Identifier\VatIdentifier;

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
     */
    private string $name;

    /**
     * BT-28
     * A name by which the Seller is known, other than Seller name (also known as Business name).
     */
    private ?string $tradingName;

    /**
     * BT-29
     * An identifier of the seller.
     *
     * Identification du Vendeur.
     *
     * @var array<int, SellerIdentifier>
     */
    private array $identifiers;

    /**
     * BT-30
     * An identifier issued by an official registrar that identifies the seller as a legal entity or person.
     */
    private ?LegalRegistrationIdentifier $legalRegistrationIdentifier;

    /**
     * BT-31
     * The Seller's VAT identifier (also known as Seller VAT identification number)
     */
    private ?VatIdentifier $vatIdentifier;

    /**
     * BT-32
     * The local identification (defined by the Seller’s address) of the Seller for tax purposes
     * or a reference that enables the Seller to state his registered tax status.
     */
    private ?TaxRegistrationIdentifier $taxRegistrationIdentifier;

    /**
     * BT-33
     * Additional legal information relevant for the Seller.
     */
    private ?string $additionalLegalInformation;

    /**
     * BT-34
     * Identifies the seller's electronic address to which the application level response to
     * the invoice may be delivered.
     */
    private ?ElectronicAddressIdentifier $electronicAddress;

    private SellerPostalAddress $address;

    private ?SellerContact $contact;

    public function __construct(string $name, SellerPostalAddress $address)
    {
        $this->name = $name;
        $this->address = $address;
        $this->identifiers = [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): SellerPostalAddress
    {
        return $this->address;
    }

    public function getTradingName(): ?string
    {
        return $this->tradingName;
    }

    public function setTradingName(?string $tradingName): self
    {
        $this->tradingName = $tradingName;

        return $this;
    }

    public function getIdentifiers(): ?array
    {
        return $this->identifiers;
    }

    public function setIdentifiers(?array $identifiers): self
    {
        $this->identifiers = $identifiers;

        return $this;
    }

    public function getLegalRegistrationIdentifier(): ?string
    {
        return $this->legalRegistrationIdentifier;
    }

    public function setLegalRegistrationIdentifier(?string $legalRegistrationIdentifier): self
    {
        $this->legalRegistrationIdentifier = $legalRegistrationIdentifier;

        return $this;
    }

    public function getVatIdentifier(): ?string
    {
        return $this->vatIdentifier;
    }

    public function setVatIdentifier(?string $vatIdentifier): self
    {
        $this->vatIdentifier = $vatIdentifier;

        return $this;
    }

    public function getTaxRegistrationIdentifier(): ?string
    {
        return $this->taxRegistrationIdentifier;
    }

    public function setTaxRegistrationIdentifier(?string $taxRegistrationIdentifier): self
    {
        $this->taxRegistrationIdentifier = $taxRegistrationIdentifier;

        return $this;
    }

    public function getAdditionalLegalInformation(): ?string
    {
        return $this->additionalLegalInformation;
    }

    public function setAdditionalLegalInformation(?string $additionalLegalInformation): self
    {
        $this->additionalLegalInformation = $additionalLegalInformation;

        return $this;
    }

    public function getElectronicAddress(): ?string
    {
        return $this->electronicAddress;
    }

    public function setElectronicAddress(?string $electronicAddress): self
    {
        $this->electronicAddress = $electronicAddress;

        return $this;
    }

    public function getContact(): SellerContact
    {
        return $this->contact;
    }

    public function hydrateXmlDocument(\DOMDocument $document): void
    {
        $applicableHeaderTradeAgreement = $document
            ->getElementsByTagName('ram:ApplicableHeaderTradeAgreement')
            ->item(0);

        $sellerTradeParty = $document->createElement('ram:SellerTradeParty');

        $sellerTradeParty->appendChild($document->createElement('ram:Name', $this->name));

        $applicableHeaderTradeAgreement->appendChild($sellerTradeParty);
    }
}
