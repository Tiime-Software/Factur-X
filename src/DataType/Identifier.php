<?php

namespace Tiime\FacturX\DataType;

class Identifier
{
    public string $value;
    public ?string $scheme;
    public ?string $schemeVersion;

    public function __construct(string $value, ?string $scheme = null, ?string $schemeVersion = null)
    {
        $this->value = $value;
        $this->scheme = $scheme;
        $this->schemeVersion = $schemeVersion;
    }
}
