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
     *
     * @var
     */
    private $point;

    /**
     * BT-42
     * A phone number for the contact point.
     *
     * @var
     */
    private $phoneNumber;

    /**
     * BT-43
     * An e-mail address for the contact point.
     *
     * @var
     */
    private $email;
}
