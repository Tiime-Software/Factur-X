<?php

declare(strict_types=1);

namespace Tiime\FacturX\Tests;

use PHPUnit\Framework\TestCase;
use Tiime\FacturX\Reader;

final class ReaderTest extends TestCase
{
    public function testExtractXmlNoValidation(): void
    {
        // Arrange
        $reader = new Reader();
        /** @var string $pdfBinary */
        $pdfBinary = file_get_contents(__DIR__ . '/fixtures/Facture_F20220023-LE_FOURNISSEUR-POUR-LE_CLIENT_BASIC_WL.pdf');

        // Act
        $xml = $reader->extractXML(
            pdfBinary: $pdfBinary,
            validateXsd: false,
        );

        // Assert
        $this->assertXmlStringEqualsXmlFile(
            __DIR__ . '/fixtures/expected_Facture_F20220023-LE_FOURNISSEUR-POUR-LE_CLIENT_BASIC_WL.xml',
            $xml,
        );
    }

    public function testExtractXmlWithValidation(): void
    {
        // Arrange
        $reader = new Reader();
        /** @var string $pdfBinary */
        $pdfBinary = file_get_contents(__DIR__ . '/fixtures/Facture_F20220023-LE_FOURNISSEUR-POUR-LE_CLIENT_BASIC_WL.pdf');

        // Act
        $xml = $reader->extractXML(
            pdfBinary: $pdfBinary,
        );

        // Assert
        $this->assertXmlStringEqualsXmlFile(
            __DIR__ . '/fixtures/expected_Facture_F20220023-LE_FOURNISSEUR-POUR-LE_CLIENT_BASIC_WL.xml',
            $xml,
        );
    }
}
