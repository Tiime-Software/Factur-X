<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-26
 * A group of business terms providing information about the period relevant for the Invoice line.
 */
class InvoiceLinePeriod
{
    /**
     * BT-134
     * The date when the Invoice period for this Invoice line starts.
     *
     * @var \DateTimeInterface|null
     */
    private $startDate;

    /**
     * BT-135
     * The date when the Invoice period for this Invoice line ends.
     *
     * @var \DateTimeInterface|null
     */
    private $endDate;
}
