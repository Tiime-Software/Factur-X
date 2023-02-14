<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-6
 * A group of business terms providing contact information about the Seller.
 */
class SellerContact
{
    /**
     * BT-41
     * A contact point for a legal entity or person.
     */
    private string $point;

    /**
     * BT-42
     * A phone number for the contact point.
     */
    private ?string $phoneNumber;

    /**
     * BT-43
     * An e-mail address for the contact point.
     */
    private ?string $email;

    public function __construct(string $point, ?string $phoneNumber, ?string $email)
    {
        if (null === $phoneNumber && null === $email) {
            // @todo exception
        }

        $this->point = $point;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
    }

    public function getPoint(): string
    {
        return $this->point;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
}
