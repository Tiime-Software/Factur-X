<?php

namespace Tiime\FacturX;

class FacturXAttachment
{
    private string $filename;

    private string $content;

    private string $description;

    public function __construct(string $content, ?string $filename = null, string $description = '')
    {
        if (strlen($content) === 0) {
            throw new \Exception('Empty content is not allowed for a PDF attachment.');
        }

        if (!is_string($filename)) {
            $this->filename = uniqid();
        } else {
            $this->filename = $filename;
        }

        $this->content = $content;
        $this->description = $description;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
