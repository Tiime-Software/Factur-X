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

    public function getLine1(): ?string
    {
        return $this->line1;
    }

    public function setLine1(?string $line1): self
    {
        $this->line1 = $line1;

        return $this;
    }

    public function getLine2(): ?string
    {
        return $this->line2;
    }

    public function setLine2(?string $line2): self
    {
        $this->line2 = $line2;

        return $this;
    }

    public function getLine3(): ?string
    {
        return $this->line3;
    }

    public function setLine3(?string $line3): self
    {
        $this->line3 = $line3;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getCountrySubdivision(): ?string
    {
        return $this->countrySubdivision;
    }

    public function setCountrySubdivision(?string $countrySubdivision): self
    {
        $this->countrySubdivision = $countrySubdivision;

        return $this;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}
