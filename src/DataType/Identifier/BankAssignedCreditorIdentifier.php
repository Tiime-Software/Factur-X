<?php

namespace Tiime\FacturX\DataType\Identifier;

class BankAssignedCreditorIdentifier
{
    public function __construct(public readonly string $value)
    {
    }
}
