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

    /**
     * BT-46
     * An identifier of the buyer.
     *
     * @var string|null
     * @todo schem identifier
     */
    private $identifier;

    /**
     * BT-47
     * An identifier issued by an official registrar that identifies the buyer as a legal entity or person.
     *
     * @var string|null
     * @todo schem identifier
     */
    private $legalRegistrationIdentifier;

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
     * @var BuyerPostalAddress
     */
    private $address;

    /**
     * BG-9
     *
     * @var BuyerContact|null
     */
    private $contact;

    /**
     * BT-49
     * Identifies the buyer's electronic address to which the invoice is delivered.
     *
     * @var string|null
     * @todo scheme identifier is mandatory
     */
    private $electronicAddress;

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

    public function getTradingName(): ?string
    {
        return $this->tradingName;
    }

    public function setTradingName(?string $tradingName): self
    {
        $this->tradingName = $tradingName;

        return $this;
    }

    public function getContact(): ?BuyerContact
    {
        return $this->contact;
    }

    public function setContact(?BuyerContact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

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

    public function getElectronicAddress(): ?string
    {
        return $this->electronicAddress;
    }

    public function setElectronicAddress(?string $electronicAddress): self
    {
        $this->electronicAddress = $electronicAddress;

        return $this;
    }

    public function hydrateXmlDocument(\DOMDocument $document): void
    {
        $applicableHeaderTradeAgreement = $document
            ->getElementsByTagName('ram:ApplicableHeaderTradeAgreement')
            ->item(0);

        if (!$applicableHeaderTradeAgreement instanceof \DOMNode) {
            throw new \RuntimeException();
        }

        $buyerTradeParty = $document->createElement('ram:BuyerTradeParty');

        $buyerTradeParty->appendChild($document->createElement('ram:Name', $this->name));

        $applicableHeaderTradeAgreement->appendChild($buyerTradeParty);
    }
}
