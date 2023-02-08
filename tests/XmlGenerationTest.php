<?php

namespace Tests\Tiime\FacturX;

use PHPUnit\Framework\TestCase;
use Tiime\FacturX\BusinessTermsGroup\Buyer;
use Tiime\FacturX\BusinessTermsGroup\BuyerPostalAddress;
use Tiime\FacturX\BusinessTermsGroup\DocumentTotals;
use Tiime\FacturX\BusinessTermsGroup\InvoiceLine;
use Tiime\FacturX\BusinessTermsGroup\InvoiceNote;
use Tiime\FacturX\BusinessTermsGroup\InvoiceNoteCode;
use Tiime\FacturX\BusinessTermsGroup\InvoiceTypeCode;
use Tiime\FacturX\BusinessTermsGroup\ItemInformation;
use Tiime\FacturX\BusinessTermsGroup\LineVatInformation;
use Tiime\FacturX\BusinessTermsGroup\PriceDetails;
use Tiime\FacturX\BusinessTermsGroup\ProcessControl;
use Tiime\FacturX\BusinessTermsGroup\Seller;
use Tiime\FacturX\BusinessTermsGroup\SellerPostalAddress;
use Tiime\FacturX\BusinessTermsGroup\VatBreakdown;
use Tiime\FacturX\DataType\CurrencyCode;
use Tiime\FacturX\DataType\Identifier;
use Tiime\FacturX\DataType\Identifier\InvoiceIdentifier;
use Tiime\FacturX\DataType\Identifier\SpecificationIdentifier;
use Tiime\FacturX\DataType\VatCategory;
use Tiime\FacturX\Invoice;

class XmlGenerationTest extends TestCase
{
    /** @var Invoice[] */
    private $invoices;
    /** @var \DOMDocument[] */
    private $invoiceXML;

    protected function setUp(): void
    {
        $this->invoices = [
            SpecificationIdentifier::MINIMUM => (new Invoice(
                new InvoiceIdentifier('34'),
                new \DateTimeImmutable(),
                InvoiceTypeCode::COMMERCIAL_INVOICE,
                CurrencyCode::EURO,
                (new ProcessControl(new SpecificationIdentifier(SpecificationIdentifier::MINIMUM)))
                    ->setBusinessProcessType('A1'),
                new Seller('John Doe', new SellerPostalAddress('FR')),
                new Buyer('Richard Roe', new BuyerPostalAddress('FR')),
                new DocumentTotals(0, 0, 0, 0),
                [new VatBreakdown(12, 2.4, VatCategory::STANDARD)],
                [new InvoiceLine(
                    new Identifier("1"),
                    1,
                    "box",
                    0,
                    new ItemInformation("A thing"),
                    new PriceDetails(12),
                    new LineVatInformation(VatCategory::STANDARD)
                )]
            ))->setBuyerReference("SERVEXEC")
            ->addIncludedNote(
                new InvoiceNote("Lorem Ipsum"),
                new InvoiceNote("Lorem Ipsum"),
            ),
            SpecificationIdentifier::BASIC => (new Invoice(
                new InvoiceIdentifier('34'),
                new \DateTimeImmutable(),
                InvoiceTypeCode::COMMERCIAL_INVOICE,
                CurrencyCode::EURO,
                (new ProcessControl(new SpecificationIdentifier(SpecificationIdentifier::BASIC)))
                    ->setBusinessProcessType('A1'),
                new Seller('John Doe', new SellerPostalAddress('FR')),
                new Buyer('Richard Roe', new BuyerPostalAddress('FR')),
                new DocumentTotals(0, 0, 0, 0),
                [new VatBreakdown(12, 2.4, VatCategory::STANDARD)],
                [new InvoiceLine(
                    new Identifier("1"),
                    1,
                    "box",
                    0, 
                    new ItemInformation("A thing"),
                    new PriceDetails(12),
                    new LineVatInformation(VatCategory::STANDARD)
                )]
            ))->setBuyerReference("SERVEXEC")
            ->addIncludedNote(
                new InvoiceNote("Lorem Ipsum"),
                new InvoiceNote("Lorem Ipsum"),
            ),
        ];

        $this->invoiceXML = [];
        foreach ($this->invoices as $profil => $invoice) {
            $this->invoiceXML[$profil] = new \DOMDocument();
            $this->invoiceXML[$profil]->loadXML($invoice->getXML()->saveXML()); 
        }
    }

    /**
     * @dataProvider XSD
     */
    public function testXSDValidation(string $profil, string $xsd)
    {
        $this->assertTrue($this->invoiceXML[$profil]->schemaValidate($xsd));
    }

    public static function XSD(): array
    {
        return [
            "MINIMUM" => [SpecificationIdentifier::MINIMUM, __DIR__ . '/xsd/1_MINIMUM_XSD/FACTUR-X_MINIMUM.xsd'],
            "BASIC" => [SpecificationIdentifier::BASIC, __DIR__ . '/xsd/2_BASIC_XSD/FACTUR-X_BASIC.xsd'],
//            "BASIC-WL" => [SpecificationIdentifier::BASIC_WL, __DIR__ . '/xsd/3_BASIC-WL_XSD/FACTUR-X_BASIC-WL.xsd'],
//            "EN16931" => [SpecificationIdentifier::EN16931, __DIR__ . '/xsd/4_EN16931_XSD/FACTUR-X_EN16931.xsd'],
//            "EXTENDED" => [SpecificationIdentifier::EXTENDED, __DIR__ . '/xsd/5_EXTENDED_XSD/FACTUR-X_EXTENDED.xsd'],
        ];
    }
}
