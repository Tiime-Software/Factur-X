<?php

namespace Tiime\FacturX\BusinessTermsGroup;

use Tiime\FacturX\DataType\Identifier;

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
    private ?Identifier $sellerIdentifier;

    /**
     * BT-156
     * An identifier, assigned by the Buyer, for the item.
     *
     */
    private ?Identifier $buyerIdentifier;

    /**
     * BT-157
     */
    private ?Identifier $standardIdentifier;

    /** @todo BT-158 */

    /**
     * BT-159
     * Item country of origin.
     *
     * Code identifiant le pays d'où provient l'article.
     *
     * EN ISO 3166-1
     */
    private ?string $itemCountryOfOrigin;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function hydrateXmlLine(\DOMDocument $document, \DOMElement $line): void
    {
        $specifiedTradeProduct = $document->createElement('ram:SpecifiedTradeProduct');

        $specifiedTradeProduct->appendChild($document->createElement('ram:Name', $this->name));

        $line->appendChild($specifiedTradeProduct);
    }
}
