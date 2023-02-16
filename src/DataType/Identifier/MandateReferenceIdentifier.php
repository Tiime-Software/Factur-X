<?php

namespace Tiime\FacturX\DataType\Identifier;

class MandateReferenceIdentifier
{
    public function __construct(public readonly string $value)
    {
    }
}
