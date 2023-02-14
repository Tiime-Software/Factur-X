<?php

namespace Tiime\FacturX\DataType\Identifier;

use Tiime\FacturX\DataType\InternationalCodeDesignator;

class SellerIdentifier
{
    public function __construct(public readonly string $value, public readonly ?InternationalCodeDesignator $scheme)
    {
    }
}
