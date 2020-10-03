<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-11
 * A group of business terms providing information about the Seller's tax representative.
 */
class SellerTaxRepresentativeParty
{
    /**
     * BT-62
     * The full name of the Seller's tax representative party.
     *
     * @var string
     */
    private $name;

    /**
     * BT-63
     * The VAT identifier of the Seller's tax representative party
     *
     * @var
     */
    private $vatIdentifier;
}
