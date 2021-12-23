<?php

namespace Tests\Tiime\FacturX;

use Atgp\FacturX\Facturx;
use PHPUnit\Framework\TestCase;
use Tiime\FacturX\BusinessTermsGroup\Buyer;
use Tiime\FacturX\BusinessTermsGroup\BuyerContact;
use Tiime\FacturX\BusinessTermsGroup\BuyerPostalAddress;
use Tiime\FacturX\BusinessTermsGroup\DocumentTotals;
use Tiime\FacturX\BusinessTermsGroup\InvoiceLine;
use Tiime\FacturX\BusinessTermsGroup\InvoiceTypeCode;
use Tiime\FacturX\BusinessTermsGroup\ProcessControl;
use Tiime\FacturX\BusinessTermsGroup\Seller;
use Tiime\FacturX\BusinessTermsGroup\SellerPostalAddress;
use Tiime\FacturX\BusinessTermsGroup\VatBreakdown;
use Tiime\FacturX\DataType\Identifier;
use Tiime\FacturX\Invoice;
use Tiime\FacturX\Serializer;

class XmlGenerationTest extends TestCase
{
    /** @var Invoice */
    private $invoice;

    protected function setUp(): void
    {
        $this->invoice = new Invoice(
            '34',
            new \DateTimeImmutable(),
            InvoiceTypeCode::COMMERCIAL_INVOICE,
            'EUR',
            (new ProcessControl(ProcessControl::MINIMUM))->setBusinessProcessType('A1'),
            new Seller('John Doe', new SellerPostalAddress('FR')),
            new Buyer('Richard Roe', new BuyerPostalAddress('FR')),
            new DocumentTotals(0, 0, 0, 0),
            [new VatBreakdown()],
            [new InvoiceLine(new Identifier("1"), 0)]
        );

        $this->invoice->setBuyerReference("SERVEXEC");
    }

    public function testXSDValidation()
    {
        $invoice = new \DOMDocument();
        $invoice->loadXML($this->invoice->getXML()->saveXML());

        $this->assertTrue($invoice->schemaValidate(__DIR__ . '/xsd/1_MINIMUM_XSD/FACTUR-X_MINIMUM.xsd'));
    }
}
