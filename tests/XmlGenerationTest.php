<?php

namespace Tests\Tiime\FacturX;

use PHPUnit\Framework\TestCase;
use Tiime\FacturX\BusinessTermsGroup\Buyer;
use Tiime\FacturX\BusinessTermsGroup\BuyerPostalAddress;
use Tiime\FacturX\BusinessTermsGroup\DocumentTotals;
use Tiime\FacturX\BusinessTermsGroup\InvoiceLine;
use Tiime\FacturX\BusinessTermsGroup\ProcessControl;
use Tiime\FacturX\BusinessTermsGroup\Seller;
use Tiime\FacturX\BusinessTermsGroup\SellerPostalAddress;
use Tiime\FacturX\BusinessTermsGroup\VatBreakdown;
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
            Invoice::TYPE_COMMERCIAL_INVOICE,
            'EUR',
            (new ProcessControl(ProcessControl::MINIMUM))->setBusinessProcessType('A1'),
            new Seller('John Doe', new SellerPostalAddress('FR')),
            new Buyer('Richard Roe', new BuyerPostalAddress('FR')),
            new DocumentTotals(),
            [new VatBreakdown()],
            [new InvoiceLine()]
        );
    }

    /** @test */
    public function xml()
    {
        file_put_contents('factu.xml', (new Serializer())->serialize($this->invoice));
        
        $this->assertSame('', (new Serializer())->serialize($this->invoice));
    }
}
