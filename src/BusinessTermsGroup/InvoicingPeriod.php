<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-14
 * A group of business terms providing information on the invoice period.
 */
class InvoicingPeriod
{
    /**
     * BT-73
     * The date when the Invoice period starts.
     *
     * @var \DateTimeInterface|null
     */
    private $startDate;

    /**
     * BT-74
     * The date when the Invoice period ends.
     *
     * @var \DateTimeInterface|null
     */
    private $endDate;
}
