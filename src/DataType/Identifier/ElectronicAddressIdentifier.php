<?php

namespace Tiime\FacturX\DataType\Identifier;

use Tiime\FacturX\DataType\ElectronicAddressScheme;

class ElectronicAddressIdentifier
{
    public function __construct(public readonly string $value, public readonly ElectronicAddressScheme $scheme)
    {
    }
}
