<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-23
 * A group of business terms providing information about VAT breakdown by different categories, rates and exemption reasons
 */
class VatBreakdown
{
    /**
     * BT-116
     * Sum of all taxable amounts subject to a specific VAT category code and VAT category rate
     * (if the VAT category rate is applicable).
     *
     * @var
     */
    private $vatCategoryTaxableAmount;

    /**
     * BT-117
     * The total VAT amount for a given VAT category.
     *
     * @var
     */
    private $vatCategoryTaxAmount;

    /**
     * BT-118
     * Coded identification of a VAT category.
     *
     * @var
     */
    private $vatCategoryCode;

    /**
     * BT-119
     * The VAT rate, represented as percentage that applies for the relevant VAT category.
     *
     * @var
     */
    private $vatCategoryRate;

    /**
     * BT-120
     * A textual statement of the reason why the amount is exempted from VAT or why no VAT is being charged
     *
     * @var
     */
    private $vatExemptionReasonText;

    /**
     * BT-121
     * A coded statement of the reason for why the amount is exempted from VAT.
     *
     * @var
     */
    private $vatExemptionReasonCode;
}
