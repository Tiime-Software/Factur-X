<?php

namespace Tiime\FacturX;

use Tiime\FacturX\BusinessTermsGroup\InvoiceNote;
use Tiime\FacturX\BusinessTermsGroup\ProcessControl;

class Serializer
{
    public function serialize(Invoice $invoice): string
    {
        $invoiceXML = new \DOMDocument('1.0', 'UTF-8');
        
        $crossIndustryInvoice = $invoiceXML->createElement('rsm:CrossIndustryInvoice');
        $crossIndustryInvoice->setAttribute('xmlns:qdt', 'urn:un:unece:uncefact:data:standard:QualifiedDataType:100');
        $crossIndustryInvoice->setAttribute('xmlns:ram', 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100');
        $crossIndustryInvoice->setAttribute('xmlns:rsm', 'urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100');
        $crossIndustryInvoice->setAttribute('xmlns:udt', 'urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100');
        $crossIndustryInvoice->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');

        $root = $invoiceXML->appendChild($crossIndustryInvoice);

        $root->appendChild($invoiceXML->createElement('rsm:ExchangedDocumentContext'));
        $root->appendChild($invoiceXML->createElement('rsm:ExchangedDocument'));
        $root->appendChild($invoiceXML->createElement('rsm:SupplyChainTradeTransaction'));

        $this->addProcessControl($invoiceXML, $invoice->getProcessControl());

        $this->addNumber($invoiceXML, $invoice->getNumber());
        $this->addTypeCode($invoiceXML, $invoice->getTypeCode());
        $this->addIssueDate($invoiceXML, $invoice->getIssueDate());
        $this->addIncludedNote($invoiceXML, ...$invoice->getInvoiceNote());
        $this->addCurrency($invoiceXML, $invoice->getCurrencyCode());

        return $invoiceXML->saveXML();
    }

    public function deserialize(string $invoice): Invoice
    {

    }
    
    private function addNumber(\DOMDocument $invoice, string $number): void
    {
        $this->appendToExchangedDocument($invoice, $invoice->createElement('ram:ID', $number));
    }
    
    private function addIncludedNote(\DOMDocument $invoice, InvoiceNote ...$note): void
    {
        foreach ($note as $invoiceNote) {
            $note = $invoice->createElement('ram:IncludedNote');
            $note->appendChild($invoice->createElement('ram:Content', $invoiceNote->getNote()));
            $note->appendChild($invoice->createElement('ram:SubjectCode', $invoiceNote->getSubjectCode()));
            
            $this->appendToExchangedDocument($invoice, $note);
        }
    }

    private function addIssueDate(\DOMDocument $invoice, \DateTimeInterface $date): void
    {
        $issueDate = $invoice->createElement('ram:IssueDateTime');
        $issueDateString = $invoice->createElement('udt:DateTimeString', $date->format('Ymd'));
        $issueDateString->setAttribute('format', '102');
        $issueDate->appendChild($issueDateString);

        $this->appendToExchangedDocument($invoice, $issueDate);
    }

    private function addTypeCode(\DOMDocument $invoice, string $typeCode): void
    {
        $this->appendToExchangedDocument($invoice, $invoice->createElement('ram:TypeCode', $typeCode));
    }

    private function addCurrency(\DOMDocument $invoice, string $currency): void
    {
        $this->appendToExchangedDocument($invoice, $invoice->createElement('ram:InvoiceCurrencyCode', $currency));
    }
    
    private function appendToExchangedDocument(\DOMDocument $invoice, \DOMElement $child): void
    {
        $invoice->getElementsByTagName('rsm:ExchangedDocument')->item(0)->appendChild($child);
    }
    
    private function addProcessControl(\DOMDocument $invoice, ProcessControl $processControl): void
    {
        $type = $invoice->createElement('ram:BusinessProcessSpecifiedDocumentContextParameter');
        $type->appendChild($invoice->createElement('ram:ID', $processControl->getBusinessProcessType()));
        $this->appendToExchangedDocumentContext($invoice, $type);

        $identifier = $invoice->createElement('ram:GuidelineSpecifiedDocumentContextParameter');
        $identifier->appendChild($invoice->createElement('ram:ID', $processControl->getSpecificationIdentifier()));
        $this->appendToExchangedDocumentContext($invoice, $identifier);
    }
    
    private function appendToExchangedDocumentContext(\DOMDocument $invoice, \DOMElement $child): void
    {
        $invoice->getElementsByTagName('rsm:ExchangedDocumentContext')->item(0)->appendChild($child);
    }
}