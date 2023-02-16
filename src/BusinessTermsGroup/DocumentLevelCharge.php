<?php

namespace Tiime\FacturX\BusinessTermsGroup;

use Tiime\FacturX\DataType\AllowanceReasonCode;
use Tiime\FacturX\DataType\VatCategory;

/**
 * BG-21
 * A group of business terms providing information about charges and taxes other than VAT,
 * applicable to the Invoice as a whole.
 */
class DocumentLevelCharge
{
    /**
     * BT-99
     * The amount of a charge, without VAT.
     */
    private float $amount;

    /**
     * BT-100
     * The base amount that may be used, in conjunction with the document level charge percentage,
     * to calculate the document level charge amount.
     */
    private ?float $baseAmount;

    /**
     * BT-101
     * The percentage that may be used, in conjunction with the document level charge base amount,
     * to calculate the document level charge amount.
     */
    private ?float $percentage;

    /**
     * BT-102
     * A coded identification of what VAT category applies to the document level charge.
     */
    private VatCategory $vatCategoryCode;

    /**
     * BT-103
     * The VAT rate, represented as percentage that applies to the document level charge.
     */
    private ?float $vatRate;

    /**
     * BT-104
     * The reason for the document level charge, expressed as text.
     */
    private ?string $reason;

    /**
     * BT-105
     * The reason for the document level charge, expressed as a code.
     */
    private ?AllowanceReasonCode $reasonCode;

    public function __construct(float $amount, VatCategory $vatCategoryCode)
    {
        $this->amount = $amount;
        $this->baseAmount = null;
        $this->percentage = null;
        $this->vatCategoryCode = $vatCategoryCode;
        $this->vatRate = null;
        $this->reason = null;
        $this->reasonCode = null;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): DocumentLevelCharge
    {
        $this->amount = $amount;

        return $this;
    }

    public function getBaseAmount(): ?float
    {
        return $this->baseAmount;
    }

    public function setBaseAmount(?float $baseAmount): DocumentLevelCharge
    {
        $this->baseAmount = $baseAmount;

        return $this;
    }

    public function getPercentage(): ?float
    {
        return $this->percentage;
    }

    public function setPercentage(?float $percentage): DocumentLevelCharge
    {
        $this->percentage = $percentage;

        return $this;
    }

    public function getVatCategoryCode(): VatCategory
    {
        return $this->vatCategoryCode;
    }

    public function setVatCategoryCode(VatCategory $vatCategoryCode): DocumentLevelCharge
    {
        $this->vatCategoryCode = $vatCategoryCode;

        return $this;
    }

    public function getVatRate(): ?float
    {
        return $this->vatRate;
    }

    public function setVatRate(?float $vatRate): DocumentLevelCharge
    {
        $this->vatRate = $vatRate;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): DocumentLevelCharge
    {
        $this->reason = $reason;

        return $this;
    }

    public function getReasonCode(): ?AllowanceReasonCode
    {
        return $this->reasonCode;
    }

    public function setReasonCode(?AllowanceReasonCode $reasonCode): DocumentLevelCharge
    {
        $this->reasonCode = $reasonCode;

        return $this;
    }
}