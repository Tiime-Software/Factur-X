<?php

namespace Tiime\FacturX;

final readonly class FacturXAttachment
{
    public string $filename;

    public function __construct(
        public string $content,
        ?string $filename = null,
        public string $description = '',
    ) {
        if ('' === $content) {
            throw new \Exception('Empty content is not allowed for a PDF attachment.');
        }

        if (!\is_string($filename)) {
            $this->filename = uniqid();
        } else {
            $this->filename = $filename;
        }
    }
}
