<?php

namespace Tiime\FacturX;

final readonly class ProfileExtractor
{
    public static function process(\DOMDocument $document): Profile
    {
        $xpath    = new \DOMXPath($document);
        $elements = $xpath->query('//rsm:ExchangedDocumentContext/ram:GuidelineSpecifiedDocumentContextParameter/ram:ID');
        \assert($elements instanceof \DOMNodeList);

        if (0 === $elements->length) {
            throw new Exception('This XML is not a Factur-X XML because it misses the XML tag ExchangedDocumentContext/GuidelineSpecifiedDocumentContextParameter/ram:ID.');
        }

        $documentIdentifierElement = $elements->item(0);
        \assert($documentIdentifierElement instanceof \DOMElement);

        $documentIdentifier = $documentIdentifierElement->nodeValue;
        \assert(\is_string($documentIdentifier));
        $explodeDocumentIdentifier = explode(':', mb_strtolower($documentIdentifier));

        $profileValue = Profile::tryFrom(end($explodeDocumentIdentifier));

        if (null !== $profileValue) {
            return $profileValue;
        }

        $previousIndex = \count($explodeDocumentIdentifier) - 2;

        if ($previousIndex < 0) {
            throw new Exception(\sprintf('Invalid Factur-X URN : %s.', $documentIdentifier));
        }

        $profileValue = Profile::tryFrom($explodeDocumentIdentifier[$previousIndex]);

        if (null !== $profileValue) {
            return $profileValue;
        }

        throw new Exception(\sprintf('Invalid Factur-X URN : %s.', $documentIdentifier));
    }
}
