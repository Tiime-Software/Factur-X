<?php

namespace Tiime\FacturX\DataType\Identifier;

class InvoiceIdentifier
{
    public function __construct(public readonly string $value)
    {
    }
}
