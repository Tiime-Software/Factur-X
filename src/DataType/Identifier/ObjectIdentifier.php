<?php

namespace Tiime\FacturX\DataType\Identifier;

use Tiime\FacturX\DataType\ObjectSchemeCode;

class ObjectIdentifier
{
    public function __construct(public readonly string $value, public readonly ?ObjectSchemeCode $scheme)
    {
    }
}
