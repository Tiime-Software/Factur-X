<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-8
 * A group of business terms providing information about the postal address for the Buyer.
 */
class BuyerPostalAddress
{
    /**
     * BT-50
     * The main address line in an address.
     *
     * @var string|null
     */
    private $line1;

    /**
     * BT-51
     * An additional address line in an address that can be used to give further details supplementing the main line.
     *
     * @var string|null
     */
    private $line2;

    /**
     * BT-163
     * An additional address line in an address that can be used to give further details supplementing the main line.
     *
     * @var string|null
     */
    private $line3;

    /**
     * BT-52
     * The common name of the city, town or village, where the Seller address is located.
     *
     * @var
     */
    private $city;

    /**
     * BT-53
     * The identifier for an addressable group of properties according to the relevant postal service.
     *
     * @var
     */
    private $postCode;

    /**
     * BT-54
     * The subdivision of a country.
     *
     * @var
     */
    private $countrySubdivision;

    /**
     * BT-55
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
