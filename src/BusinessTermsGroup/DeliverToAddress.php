<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-15
 * A group of business terms providing information about the address to which goods and services invoiced were or are delivered.
 */
class DeliverToAddress
{
    /**
     * BT-37
     * The main address line in an address.
     *
     * @var string|null
     */
    private $line1;

    /**
     * BT-76
     * An additional address line in an address that can be used to give further details supplementing the main line.
     *
     * @var string|null
     */
    private $line2;

    /**
     * BT-165
     * An additional address line in an address that can be used to give further details supplementing the main line.
     *
     * @var string|null
     */
    private $line3;

    /**
     * BT-77
     * The common name of the city, town or village, where the Seller address is located.
     *
     * @var
     */
    private $city;

    /**
     * BT-78
     * The identifier for an addressable group of properties according to the relevant postal service.
     *
     * @var
     */
    private $postCode;

    /**
     * BT-79
     * The subdivision of a country.
     *
     * @var
     */
    private $countrySubdivision;

    /**
     * BT-80
     * A code that identifies the country.
     *
     * @var
     */
    private $countryCode;
}
