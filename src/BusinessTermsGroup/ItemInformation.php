<?php

namespace Tiime\FacturX\BusinessTermsGroup;

use Tiime\FacturX\DataType\CountryAlpha2Code;
use Tiime\FacturX\DataType\Identifier\BuyerItemIdentifier;
use Tiime\FacturX\DataType\Identifier\ItemClassificationIdentifier;
use Tiime\FacturX\DataType\Identifier\SellerItemIdentifier;
use Tiime\FacturX\DataType\Identifier\StandardItemIdentifier;

/**
 * BG-31
 * A group of business terms providing information about the goods and services invoiced.
 */
class ItemInformation
{
    /**
     * BT-153
     * A name for an item.
     *
     */
    private string $name;

    /**
     * BT-154
     * A description for an item.
     *
     */
    private ?string $description;

    /**
     * BT-155
     * An identifier, assigned by the Seller, for the item.
     *
     */
    private ?SellerItemIdentifier $sellerIdentifier;

    /**
     * BT-156
     * An identifier, assigned by the Buyer, for the item.
     *
     */
    private ?BuyerItemIdentifier $buyerIdentifier;

    /**
     * BT-157
     */
    private ?StandardItemIdentifier $standardIdentifier;

    /**
     * @var array<int, ItemClassificationIdentifier>
     */
    private array $classificationIdentifiers;

    /**
     * BT-159
     * Item country of origin.
     *
     * Code identifiant le pays d'où provient l'article.
     */
    private ?CountryAlpha2Code $itemCountryOfOrigin;

    /** @var array<int, ItemAttribute> */
    private array $itemAttributes;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->description = null;
        $this->sellerIdentifier = null;
        $this->buyerIdentifier = null;
        $this->standardIdentifier = null;
        $this->classificationIdentifiers = [];
        $this->itemCountryOfOrigin = null;
        $this->itemAttributes = [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ItemInformation
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): ItemInformation
    {
        $this->description = $description;

        return $this;
    }

    public function getSellerIdentifier(): ?SellerItemIdentifier
    {
        return $this->sellerIdentifier;
    }

    public function setSellerIdentifier(?SellerItemIdentifier $sellerIdentifier): ItemInformation
    {
        $this->sellerIdentifier = $sellerIdentifier;

        return $this;
    }

    public function getBuyerIdentifier(): ?BuyerItemIdentifier
    {
        return $this->buyerIdentifier;
    }

    public function setBuyerIdentifier(?BuyerItemIdentifier $buyerIdentifier): ItemInformation
    {
        $this->buyerIdentifier = $buyerIdentifier;

        return $this;
    }

    public function getStandardIdentifier(): ?StandardItemIdentifier
    {
        return $this->standardIdentifier;
    }

    public function setStandardIdentifier(?StandardItemIdentifier $standardIdentifier): ItemInformation
    {
        $this->standardIdentifier = $standardIdentifier;

        return $this;
    }

    /**
     * @return array<int, ItemClassificationIdentifier>
     */
    public function getClassificationIdentifiers(): array
    {
        return $this->classificationIdentifiers;
    }

    /**
     * @param array<int, ItemClassificationIdentifier> $classificationIdentifiers
     */
    public function setClassificationIdentifiers(array $classificationIdentifiers): ItemInformation
    {
        $this->classificationIdentifiers = $classificationIdentifiers;

        return $this;
    }

    public function getItemCountryOfOrigin(): ?CountryAlpha2Code
    {
        return $this->itemCountryOfOrigin;
    }

    public function setItemCountryOfOrigin(?CountryAlpha2Code $itemCountryOfOrigin): ItemInformation
    {
        $this->itemCountryOfOrigin = $itemCountryOfOrigin;

        return $this;
    }

    public function hydrateXmlLine(\DOMDocument $document, \DOMElement $line): void
    {
        $specifiedTradeProduct = $document->createElement('ram:SpecifiedTradeProduct');

        $specifiedTradeProduct->appendChild($document->createElement('ram:Name', $this->name));

        $line->appendChild($specifiedTradeProduct);
    }

    /**
     * @return array<int, ItemAttribute>
     */
    public function getItemAttributes(): array
    {
        return $this->itemAttributes;
    }

    /**
     * @param array<int, ItemAttribute> $itemAttributes
     */
    public function setItemAttributes(array $itemAttributes): self
    {
        $this->itemAttributes = $itemAttributes;

        return $this;
    }
}
