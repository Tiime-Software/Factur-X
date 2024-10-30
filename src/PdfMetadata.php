<?php

namespace Tiime\FacturX;

final readonly class PdfMetadata
{
    public function __construct(
        public ?string $author,
        public ?string $keywords,
        public ?string $title,
        public ?string $subject,
        public ?string $createdDate,
        public ?string $modifiedDate,
    ) {
    }
}
