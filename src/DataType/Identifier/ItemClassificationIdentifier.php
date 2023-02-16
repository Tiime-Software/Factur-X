<?php

namespace Tiime\FacturX\DataType\Identifier;

use Tiime\FacturX\DataType\ItemTypeCode;

class ItemClassificationIdentifier
{
    public function __construct(
        public readonly string $value,
        public readonly ItemTypeCode $scheme,
        public readonly string $version,
    ) {
    }
}
