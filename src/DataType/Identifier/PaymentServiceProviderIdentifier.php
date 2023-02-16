<?php

namespace Tiime\FacturX\DataType\Identifier;

class PaymentServiceProviderIdentifier
{
    public function __construct(public readonly string $value)
    {
    }
}
