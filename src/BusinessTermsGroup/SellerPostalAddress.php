<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-5
 * A group of business terms providing information about the address of the Seller.
 */
class SellerPostalAddress
{
    /**
     * BT-35
     * The main address line in an address.
     *
     * @var string|null
     */
    private $line1;

    /**
     * BT-36
     * An additional address line in an address that can be used to give further details supplementing the main line.
     *
     * @var string|null
     */
    private $line2;

    /**
     * BT-162
     * An additional address line in an address that can be used to give further details supplementing the main line.
     *
     * @var string|null
     */
    private $line3;

    /**
     * BT-37
     * The common name of the city, town or village, where the Seller address is located.
     *
     * @var string|null
     */
    private $city;

    /**
     * BT-38
     * The identifier for an addressable group of properties according to the relevant postal service.
     *
     * @var string|null
     */
    private $postCode;

    /**
     * BT-39
     * The subdivision of a country.
     *
     * @var string|null
     */
    private $countrySubdivision;

    /**
     * BT-40
     * A code that identifies the country.
     *
     * @var string
     */
    private $countryCode;

    public function __construct(string $countryCode)
    {
        $this->countryCode = $countryCode;
    }

}
