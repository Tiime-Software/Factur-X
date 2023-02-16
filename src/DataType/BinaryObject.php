<?php

namespace Tiime\FacturX\DataType;

class BinaryObject
{
    public function __construct(
        public readonly mixed $content,
        public readonly MimeCode $mimeCode,
        public readonly string $filename
    ) {
        if (!is_resource($content)) {
            throw new \TypeError(sprintf(
                'BinaryObject#$content expected resource, %s given.',
                getType($this->content)
            ));
        }
    }
}
