<?php

namespace Tiime\FacturX\BusinessTermsGroup;

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
     * @var
     */
    private $name;

    /**
     * BT-154
     * A description for an item.
     *
     * @var
     */
    private $description;

    /**
     * BT-155
     * An identifier, assigned by the Seller, for the item.
     *
     * @var
     */
    private $itemSellerIdentifier;

    /**
     * BT-156
     * An identifier, assigned by the Buyer, for the item.
     *
     * @var
     */
    private $itemBuyerIdentifier;

    /** @todo BT-157 */
    /** @todo BT-158 */

    /**
     * BT-159
     * Item country of origin.
     *
     * @var
     */
    private $itemCountryOfOrigin;
}
