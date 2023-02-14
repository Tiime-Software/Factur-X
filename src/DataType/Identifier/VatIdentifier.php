<?php

namespace Tiime\FacturX\DataType\Identifier;

class VatIdentifier
{
    public function __construct(public readonly string $value)
    {
        // @todo : $value should be typed VatIdentificationNumber
    }
}
