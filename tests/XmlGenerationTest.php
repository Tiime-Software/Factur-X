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

class XmlGenerationTest extends TestCase
{
    /** @var Invoice */
    private $invoice;

    protected function setUp(): void
    {
        $this->invoice = new Invoice(
            '34',
            new \DateTimeImmutable(),
            'ZC',
            'EUR',
            new ProcessControl(),
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
        $this->assertSame('', $this->invoice->getXml());
    }
}
