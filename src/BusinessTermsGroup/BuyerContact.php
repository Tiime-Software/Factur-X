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
     * @var
     */
    private $point;

    /**
     * BT-57
     * A phone number for the contact point.
     *
     * @var
     */
    private $phoneNumber;

    /**
     * BT-58
     * An e-mail address for the contact point.
     *
     * @var
     */
    private $email;
}
