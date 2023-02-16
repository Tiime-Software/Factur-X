<?php

namespace Tiime\FacturX\DataType\Identifier;

class PaymentAccountIdentifier
{
    public function __construct(public readonly string $value)
    {
    }
}
