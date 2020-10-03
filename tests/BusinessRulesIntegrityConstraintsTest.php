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

class BusinessRulesIntegrityConstraintsTest extends TestCase
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


    /** @test BR-1 */
    public function an_invoice_shall_have_a_specification_identifier()
    {
        $this->markTestSkipped('@todo');
    }

    /** @test BR-2 */
    public function an_invoice_shall_have_an_invoice_number()
    {
        $this->assertSame('34', $this->invoice->getNumber());
    }

    /** @test BR-3 */
    public function an_invoice_shall_have_an_invoice_issue_date()
    {
        $this->assertInstanceOf(\DateTimeInterface::class, $this->invoice->getIssueDate());
    }

    /** @test BR-4 */
    public function an_invoice_shall_have_an_invoice_type_code()
    {
        $this->assertSame('ZC', $this->invoice->getTypeCode());
    }

    /** @test BR-5 */
    public function an_invoice_shall_have_an_invoice_currency_code()
    {
        $this->assertSame('EUR', $this->invoice->getCurrencyCode());
    }

    /** @test BR-6 */
    public function an_invoice_shall_contain_the_seller_name()
    {
        $this->assertSame('John Doe', $this->invoice->getSeller()->getName());
    }

    /** @test BR-7 */
    public function an_invoice_shall_contain_the_buyer_name()
    {
        $this->assertSame('Richard Roe', $this->invoice->getBuyer()->getName());
    }
}
