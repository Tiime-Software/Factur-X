<?php

namespace Tiime\FacturX\DataType\Identifier;

class DebitedAccountIdentifier
{
    public function __construct(public readonly string $value)
    {
    }
}
