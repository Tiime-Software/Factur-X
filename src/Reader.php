<?php

namespace Tiime\FacturX;

use Smalot\PdfParser\Parser;

class Reader
{
    public function extractXML(
        string $pdfBinary,
        bool $validateXsd = true,
    ): string {
        try {
            $parser    = new Parser();
            $pdfParsed = $parser->parseContent($pdfBinary);
            $xml       = null;

            foreach ($pdfParsed->getObjectsByType('Filespec') as $spec) {
                if ('factur-x.xml' !== $spec->get('F')->getContent()) {
                    continue;
                }

                // Not an embedded file
                if (!$spec->has('EF')) {
                    continue;
                }

                $embeddedFileReference = $spec->get('EF');

                if (!$embeddedFileReference->has('F')) {
                    // /EF /F contains reference to /EmbeddedFile object
                    // (raw reference is not displayable with Smalot)
                    continue;
                }

                // Smalot resolve embedded stream content directly (without need to search /EmbeddedFile by reference)
                if (null === $xml = $embeddedFileReference->get('F')->getContent()) {
                    throw new \RuntimeException('EmbeddedFile not readable.');
                }
            }

            if (!$xml) {
                throw new \RuntimeException('Factur-x Filespec not found.');
            }
        } catch (\Exception $e) {
            throw new \Exception('Unable to get Factur-X Xml from PDF : ' . $e);
        }

        if ($validateXsd) {
            $document = new \DOMDocument();
            $document->loadXML($xml);

            $profile = ProfileExtractor::process($document);
            (new XsdProcessor($profile))->validate($xml);
        }

        return $xml;
    }
}
