<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-2
 * A group of business terms providing information on the business process and rules applicable to the Invoice document.
 */
class ProcessControl
{
    const DEFAULT_IDENTIFIER = 'urn:cen.eu:en16931:2017';
    
    const BASIC = 'urn:cen.eu:en16931#compliant#factur-x.eu:1p0:basic';

    /**
     * BT-23
     * Identifies the business process context in which the transaction appears,
     * to enable the Buyer to process the Invoice in an appropriate way.
     *
     * @var string|null
     */
    private $businessProcessType;

    /**
     * BT-24
     * An identification of the specification containing the total set of rules regarding semantic content,
     * cardinalities and business rules to which the data contained in the instance document conforms.
     *
     * @var string
     */
    private $specificationIdentifier;

    public function __construct(string $specificationIdentifier = self::DEFAULT_IDENTIFIER)
    {
        $this->specificationIdentifier = $specificationIdentifier;
    }

    public function getBusinessProcessType(): ?string
    {
        return $this->businessProcessType;
    }

    public function setBusinessProcessType(?string $businessProcessType): self
    {
        $this->businessProcessType = $businessProcessType;

        return $this;
    }

    public function getSpecificationIdentifier(): string
    {
        return $this->specificationIdentifier;
    }
}
