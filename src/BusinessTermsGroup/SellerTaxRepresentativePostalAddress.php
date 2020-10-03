<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-12
 * A group of business terms providing information about the postal address for the tax representative party.
 */
class SellerTaxRepresentativePostalAddress
{
    /**
     * BT-64
     * The main address line in an address.
     *
     * @var string|null
     */
    private $line1;

    /**
     * BT-65
     * An additional address line in an address that can be used to give further details supplementing the main line.
     *
     * @var string|null
     */
    private $line2;

    /**
     * BT-164
     * An additional address line in an address that can be used to give further details supplementing the main line.
     *
     * @var string|null
     */
    private $line3;

    /**
     * BT-66
     * The common name of the city, town or village, where the Seller address is located.
     *
     * @var
     */
    private $city;

    /**
     * BT-67
     * The identifier for an addressable group of properties according to the relevant postal service.
     *
     * @var
     */
    private $postCode;

    /**
     * BT-68
     * The subdivision of a country.
     *
     * @var
     */
    private $countrySubdivision;

    /**
     * BT-69
     * A code that identifies the country.
     *
     * @var
     */
    private $countryCode;
}
