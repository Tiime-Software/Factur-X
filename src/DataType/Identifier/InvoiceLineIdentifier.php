<?php

namespace Tiime\FacturX\DataType\Identifier;

class InvoiceLineIdentifier
{
    public function __construct(public readonly string $value)
    {
    }
}
