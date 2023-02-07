<?php

namespace Tiime\FacturX\DataType\Reference;

abstract class DocumentReference
{
    public function __construct(public readonly string $value)
    {
    }
}
