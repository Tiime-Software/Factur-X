<?php

namespace Tiime\FacturX;

class XsdValidationException extends \Exception
{
    /**
     * @param \LibXMLError[] $xmlErrors
     */
    public function __construct(
        public array $xmlErrors = [],
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
