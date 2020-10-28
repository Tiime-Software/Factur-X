<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-9
 * A group of business terms providing contact information relevant for the Buyer.
 */
class BuyerContact
{
    /**
     * BT-56
     * A contact point for a legal entity or person.
     *
     * @var string
     */
    private $point;

    /**
     * BT-57
     * A phone number for the contact point.
     *
     * @var string|null
     */
    private $phoneNumber;

    /**
     * BT-58
     * An e-mail address for the contact point.
     *
     * @var string|null
     */
    private $email;

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
