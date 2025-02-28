<?php

namespace Tiime\FacturX\Tests;

use PHPUnit\Framework\TestCase;
use Tiime\FacturX\Reader;
use Tiime\FacturX\Writer;

class FacturXTest extends TestCase
{
    public function testGenerateMinimumProfileFacturX(): void
    {
        $pdfFilePath = __DIR__ . \DIRECTORY_SEPARATOR . 'sample.pdf';
        $pdfContent  = file_get_contents($pdfFilePath);
        \assert(\is_string($pdfContent));
        $xml = <<<XML
<?xml version='1.0' encoding='UTF-8'?>
<rsm:CrossIndustryInvoice xmlns:qdt="urn:un:unece:uncefact:data:standard:QualifiedDataType:100"
xmlns:ram="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100"
xmlns:rsm="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100"
xmlns:udt="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
     <rsm:ExchangedDocumentContext>
          <ram:BusinessProcessSpecifiedDocumentContextParameter>
               <ram:ID>A1</ram:ID>
          </ram:BusinessProcessSpecifiedDocumentContextParameter>
          <ram:GuidelineSpecifiedDocumentContextParameter>
               <ram:ID>urn:factur-x.eu:1p0:minimum</ram:ID>
          </ram:GuidelineSpecifiedDocumentContextParameter>
     </rsm:ExchangedDocumentContext>
     <rsm:ExchangedDocument>
          <ram:ID>F20220023</ram:ID>
          <ram:TypeCode>380</ram:TypeCode>
          <ram:IssueDateTime>
               <udt:DateTimeString format="102">20220131</udt:DateTimeString>
          </ram:IssueDateTime>
     </rsm:ExchangedDocument>
     <rsm:SupplyChainTradeTransaction>
          <ram:ApplicableHeaderTradeAgreement>
               <ram:BuyerReference>SERVEXEC</ram:BuyerReference>
               <ram:SellerTradeParty>
                    <ram:Name>LE FOURNISSEUR</ram:Name>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">123456782</ram:ID>
                    </ram:SpecifiedLegalOrganization>
                    <ram:PostalTradeAddress>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR11123456782</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:SellerTradeParty>
               <ram:BuyerTradeParty>
                    <ram:Name>LE CLIENT</ram:Name>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">987654321</ram:ID>
                    </ram:SpecifiedLegalOrganization>
               </ram:BuyerTradeParty>
               <ram:BuyerOrderReferencedDocument>
                    <ram:IssuerAssignedID>PO201925478</ram:IssuerAssignedID>
               </ram:BuyerOrderReferencedDocument>
          </ram:ApplicableHeaderTradeAgreement>
          <ram:ApplicableHeaderTradeDelivery/>
          <ram:ApplicableHeaderTradeSettlement>
               <ram:InvoiceCurrencyCode>EUR</ram:InvoiceCurrencyCode>
               <ram:SpecifiedTradeSettlementHeaderMonetarySummation>
                    <ram:TaxBasisTotalAmount>100.00</ram:TaxBasisTotalAmount>
                    <ram:TaxTotalAmount currencyID="EUR">4.90</ram:TaxTotalAmount>
                    <ram:GrandTotalAmount>104.90</ram:GrandTotalAmount>
                    <ram:DuePayableAmount>104.90</ram:DuePayableAmount>
               </ram:SpecifiedTradeSettlementHeaderMonetarySummation>
          </ram:ApplicableHeaderTradeSettlement>
     </rsm:SupplyChainTradeTransaction>
</rsm:CrossIndustryInvoice>
XML;

        $writer = (new Writer())->generate(
            pdfContent: $pdfContent,
            xmlContent: $xml,
            addLogo: true
        );

        file_put_contents(__DIR__ . \DIRECTORY_SEPARATOR . 'minimum_facturx.pdf', $writer);

        $extractedXml = (new Reader())->extractXML($writer);
        $this->assertSame($xml, $extractedXml);
    }

    public function testGenerateBasicWLProfileFacturX(): void
    {
        $pdfFilePath = __DIR__ . \DIRECTORY_SEPARATOR . 'sample.pdf';
        $pdfContent  = file_get_contents($pdfFilePath);
        \assert(\is_string($pdfContent));
        $xml = <<<XML
<?xml version='1.0' encoding='UTF-8'?>
<rsm:CrossIndustryInvoice xmlns:qdt="urn:un:unece:uncefact:data:standard:QualifiedDataType:100"
xmlns:ram="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100"
xmlns:rsm="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100"
xmlns:udt="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
     <rsm:ExchangedDocumentContext>
          <ram:BusinessProcessSpecifiedDocumentContextParameter>
               <ram:ID>A1</ram:ID>
          </ram:BusinessProcessSpecifiedDocumentContextParameter>
          <ram:GuidelineSpecifiedDocumentContextParameter>
               <ram:ID>urn:factur-x.eu:1p0:basicwl</ram:ID>
          </ram:GuidelineSpecifiedDocumentContextParameter>
     </rsm:ExchangedDocumentContext>
     <rsm:ExchangedDocument>
          <ram:ID>F20220023</ram:ID>
          <ram:TypeCode>380</ram:TypeCode>
          <ram:IssueDateTime>
               <udt:DateTimeString format="102">20220131</udt:DateTimeString>
          </ram:IssueDateTime>
          <ram:IncludedNote>
               <ram:Content>FOURNISSEUR F SARL au capital de 50 000 EUR</ram:Content>
               <ram:SubjectCode>REG</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>RCS MAVILLE 123 456 782</ram:Content>
               <ram:SubjectCode>ABL</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>35 ma rue a moi, code postal Ville Pays – contact@masociete.fr - www.masociete.fr  – N° TVA : FR32 123 456 789</ram:Content>
               <ram:SubjectCode>AAI</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>Tout retard de paiement engendre une pénalité exigible à compter de la date d'échéance, calculée sur la base de trois fois le taux d'intérêt légal. </ram:Content>
               <ram:SubjectCode>PMD</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>Indemnité forfaitaire pour frais de recouvrement en cas de retard de paiement : 40 €.</ram:Content>
               <ram:SubjectCode>PMT</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>Les réglements reçus avant la date d'échéance ne donneront pas lieu à escompte.</ram:Content>
               <ram:SubjectCode>AAB</ram:SubjectCode>
          </ram:IncludedNote>
     </rsm:ExchangedDocument>
     <rsm:SupplyChainTradeTransaction>
          <ram:ApplicableHeaderTradeAgreement>
               <ram:BuyerReference>SERVEXEC</ram:BuyerReference>
               <ram:SellerTradeParty>
                    <ram:ID>123</ram:ID>
                    <ram:GlobalID schemeID="0088">587451236587</ram:GlobalID>
                    <ram:GlobalID schemeID="0009">12345678200077</ram:GlobalID>
                    <ram:GlobalID schemeID="0060">DUNS1235487</ram:GlobalID>
                    <ram:GlobalID schemeID="0177">ODETTE254879</ram:GlobalID>
                    <ram:Name>LE FOURNISSEUR</ram:Name>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">123456782</ram:ID>
                         <ram:TradingBusinessName>SELLER TRADE NAME</ram:TradingBusinessName>
                    </ram:SpecifiedLegalOrganization>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>75018</ram:PostcodeCode>
                         <ram:LineOne>35 rue d'ici</ram:LineOne>
                         <ram:LineTwo>Seller line 2</ram:LineTwo>
                         <ram:LineThree>Seller line 3</ram:LineThree>
                         <ram:CityName>PARIS</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:URIUniversalCommunication>
                         <ram:URIID schemeID="EM">moi@seller.com</ram:URIID>
                    </ram:URIUniversalCommunication>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR11123456782</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:SellerTradeParty>
               <ram:BuyerTradeParty>
                    <ram:GlobalID schemeID="0088">3654789851</ram:GlobalID>
                    <ram:Name>LE CLIENT</ram:Name>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">987654321</ram:ID>
                    </ram:SpecifiedLegalOrganization>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>06000</ram:PostcodeCode>
                         <ram:LineOne>MON ADRESSE LIGNE 1</ram:LineOne>
                         <ram:LineTwo>Buyer line 2</ram:LineTwo>
                         <ram:LineThree>Buyer line 3</ram:LineThree>
                         <ram:CityName>MA VILLE</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:URIUniversalCommunication>
                         <ram:URIID schemeID="EM">me@buyer.com</ram:URIID>
                    </ram:URIUniversalCommunication>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR 05 987 654 321</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:BuyerTradeParty>
               <ram:SellerTaxRepresentativeTradeParty>
                    <ram:Name>SELLER TAX REP</ram:Name>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>75018</ram:PostcodeCode>
                         <ram:LineOne>35 rue d'ici</ram:LineOne>
                         <ram:LineTwo>Seller line 2</ram:LineTwo>
                         <ram:LineThree>Seller line 3</ram:LineThree>
                         <ram:CityName>PARIS</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR 05 987 654 321</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:SellerTaxRepresentativeTradeParty>
               <ram:BuyerOrderReferencedDocument>
                    <ram:IssuerAssignedID>PO201925478</ram:IssuerAssignedID>
               </ram:BuyerOrderReferencedDocument>
               <ram:ContractReferencedDocument>
                    <ram:IssuerAssignedID>CT2018120802</ram:IssuerAssignedID>
               </ram:ContractReferencedDocument>
          </ram:ApplicableHeaderTradeAgreement>
          <ram:ApplicableHeaderTradeDelivery>
               <ram:ShipToTradeParty>
                    <ram:ID>PRIVATE_ID_DEL</ram:ID>
                    <ram:Name>DEL Name</ram:Name>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>06000</ram:PostcodeCode>
                         <ram:LineOne>DEL ADRESSE LIGNE 1</ram:LineOne>
                         <ram:LineTwo>DEL line 2</ram:LineTwo>
                         <ram:CityName>NICE</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
               </ram:ShipToTradeParty>
               <ram:ActualDeliverySupplyChainEvent>
                    <ram:OccurrenceDateTime>
                         <udt:DateTimeString format="102">20220128</udt:DateTimeString>
                    </ram:OccurrenceDateTime>
               </ram:ActualDeliverySupplyChainEvent>
               <ram:DespatchAdviceReferencedDocument>
                    <ram:IssuerAssignedID>DESPADV002</ram:IssuerAssignedID>
               </ram:DespatchAdviceReferencedDocument>
          </ram:ApplicableHeaderTradeDelivery>
          <ram:ApplicableHeaderTradeSettlement>
               <ram:CreditorReferenceID>CREDID</ram:CreditorReferenceID>
               <ram:PaymentReference>F20180023BUYER</ram:PaymentReference>
               <ram:InvoiceCurrencyCode>EUR</ram:InvoiceCurrencyCode>
               <ram:PayeeTradeParty>
                    <ram:GlobalID schemeID="0088">587451236586</ram:GlobalID>
                    <ram:Name>PAYEE NAME</ram:Name>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">303656847</ram:ID>
                    </ram:SpecifiedLegalOrganization>
               </ram:PayeeTradeParty>
               <ram:SpecifiedTradeSettlementPaymentMeans>
                    <ram:TypeCode>30</ram:TypeCode>
                    <ram:PayerPartyDebtorFinancialAccount>
                         <ram:IBANID>FRDEBIT</ram:IBANID>
                    </ram:PayerPartyDebtorFinancialAccount>
                    <ram:PayeePartyCreditorFinancialAccount>
                         <ram:IBANID>FR20 1254 2547 2569 8542 5874 698</ram:IBANID>
                         <ram:ProprietaryID>LOC BANK ACCOUNT</ram:ProprietaryID>
                    </ram:PayeePartyCreditorFinancialAccount>
               </ram:SpecifiedTradeSettlementPaymentMeans>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>2.20</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:BasisAmount>11.00</ram:BasisAmount>
                    <ram:CategoryCode>S</ram:CategoryCode>
                    <ram:DueDateTypeCode>72</ram:DueDateTypeCode>
                    <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>0.00</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:ExemptionReason>DEBOURS</ram:ExemptionReason>
                    <ram:BasisAmount>60.00</ram:BasisAmount>
                    <ram:CategoryCode>E</ram:CategoryCode>
                    <ram:ExemptionReasonCode>VATEX-EU-79-C</ram:ExemptionReasonCode>
                    <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>2.70</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:BasisAmount>27.00</ram:BasisAmount>
                    <ram:CategoryCode>S</ram:CategoryCode>
                    <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>0.00</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:ExemptionReason>LIVRAISON INTRACOMMUNAUTAIRE</ram:ExemptionReason>
                    <ram:BasisAmount>2.00</ram:BasisAmount>
                    <ram:CategoryCode>K</ram:CategoryCode>
                    <ram:ExemptionReasonCode>VATEX-EU-IC</ram:ExemptionReasonCode>
                    <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:BillingSpecifiedPeriod>
                    <ram:StartDateTime>
                         <udt:DateTimeString format="102">20220101</udt:DateTimeString>
                    </ram:StartDateTime>
                    <ram:EndDateTime>
                         <udt:DateTimeString format="102">20221231</udt:DateTimeString>
                    </ram:EndDateTime>
               </ram:BillingSpecifiedPeriod>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>5.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>5.00</ram:ActualAmount>
                    <ram:ReasonCode>95</ram:ReasonCode>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>100</ram:ReasonCode>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>100</ram:ReasonCode>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>2.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>2.00</ram:ActualAmount>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>10.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>10.00</ram:ActualAmount>
                    <ram:ReasonCode>FC</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>ADR</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>2.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>2.00</ram:ActualAmount>
                    <ram:ReasonCode>FC</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>K</ram:CategoryCode>
                         <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>FC</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradePaymentTerms>
                    <ram:Description>PAIEMENT 30 JOURS NET</ram:Description>
                    <ram:DueDateDateTime>
                         <udt:DateTimeString format="102">20220302</udt:DateTimeString>
                    </ram:DueDateDateTime>
                    <ram:DirectDebitMandateID>MANDATE PT</ram:DirectDebitMandateID>
               </ram:SpecifiedTradePaymentTerms>
               <ram:SpecifiedTradeSettlementHeaderMonetarySummation>
                    <ram:LineTotalAmount>95.00</ram:LineTotalAmount>
                    <ram:ChargeTotalAmount>14.00</ram:ChargeTotalAmount>
                    <ram:AllowanceTotalAmount>9.00</ram:AllowanceTotalAmount>
                    <ram:TaxBasisTotalAmount>100.00</ram:TaxBasisTotalAmount>
                    <ram:TaxTotalAmount currencyID="EUR">4.90</ram:TaxTotalAmount>
                    <ram:GrandTotalAmount>104.90</ram:GrandTotalAmount>
                    <ram:TotalPrepaidAmount>0.00</ram:TotalPrepaidAmount>
                    <ram:DuePayableAmount>104.90</ram:DuePayableAmount>
               </ram:SpecifiedTradeSettlementHeaderMonetarySummation>
               <ram:InvoiceReferencedDocument>
                    <ram:IssuerAssignedID>F20220003</ram:IssuerAssignedID>
                    <ram:FormattedIssueDateTime>
                         <qdt:DateTimeString format="102">20220101</qdt:DateTimeString>
                    </ram:FormattedIssueDateTime>
               </ram:InvoiceReferencedDocument>
               <ram:ReceivableSpecifiedTradeAccountingAccount>
                    <ram:ID>BUYER ACCOUNT REF</ram:ID>
               </ram:ReceivableSpecifiedTradeAccountingAccount>
          </ram:ApplicableHeaderTradeSettlement>
     </rsm:SupplyChainTradeTransaction>
</rsm:CrossIndustryInvoice>
XML;

        $writer = (new Writer())->generate(
            pdfContent: $pdfContent,
            xmlContent: $xml,
            addLogo: true
        );

        file_put_contents(__DIR__ . \DIRECTORY_SEPARATOR . 'basicwl_facturx.pdf', $writer);

        $extractedXml = (new Reader())->extractXML($writer);
        $this->assertSame($xml, $extractedXml);
    }

    public function testGenerateBasicProfileFacturX(): void
    {
        $pdfFilePath = __DIR__ . \DIRECTORY_SEPARATOR . 'sample.pdf';
        $pdfContent  = file_get_contents($pdfFilePath);
        \assert(\is_string($pdfContent));
        $xml = <<<XML
<?xml version='1.0' encoding='UTF-8'?>
<rsm:CrossIndustryInvoice xmlns:qdt="urn:un:unece:uncefact:data:standard:QualifiedDataType:100"
xmlns:ram="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100"
xmlns:rsm="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100"
xmlns:udt="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
     <rsm:ExchangedDocumentContext>
          <ram:BusinessProcessSpecifiedDocumentContextParameter>
               <ram:ID>A1</ram:ID>
          </ram:BusinessProcessSpecifiedDocumentContextParameter>
          <ram:GuidelineSpecifiedDocumentContextParameter>
               <ram:ID>urn:cen.eu:en16931:2017#compliant#urn:factur-x.eu:1p0:basic</ram:ID>
          </ram:GuidelineSpecifiedDocumentContextParameter>
     </rsm:ExchangedDocumentContext>
     <rsm:ExchangedDocument>
          <ram:ID>F20220023</ram:ID>
          <ram:TypeCode>380</ram:TypeCode>
          <ram:IssueDateTime>
               <udt:DateTimeString format="102">20220131</udt:DateTimeString>
          </ram:IssueDateTime>
          <ram:IncludedNote>
               <ram:Content>FOURNISSEUR F SARL au capital de 50 000 EUR</ram:Content>
               <ram:SubjectCode>REG</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>RCS MAVILLE 123 456 782</ram:Content>
               <ram:SubjectCode>ABL</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>35 ma rue a moi, code postal Ville Pays – contact@masociete.fr - www.masociete.fr  – N° TVA : FR32 123 456 789</ram:Content>
               <ram:SubjectCode>AAI</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>Tout retard de paiement engendre une pénalité exigible à compter de la date d'échéance, calculée sur la base de trois fois le taux d'intérêt légal. </ram:Content>
               <ram:SubjectCode>PMD</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>Indemnité forfaitaire pour frais de recouvrement en cas de retard de paiement : 40 €.</ram:Content>
               <ram:SubjectCode>PMT</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>Les réglements reçus avant la date d'échéance ne donneront pas lieu à escompte.</ram:Content>
               <ram:SubjectCode>AAB</ram:SubjectCode>
          </ram:IncludedNote>
     </rsm:ExchangedDocument>
     <rsm:SupplyChainTradeTransaction>
          <ram:IncludedSupplyChainTradeLineItem>
               <ram:AssociatedDocumentLineDocument>
                    <ram:LineID>1</ram:LineID>
                    <ram:IncludedNote>
                         <ram:Content>DONT 0,50 EUR de DEEE</ram:Content>
                    </ram:IncludedNote>
               </ram:AssociatedDocumentLineDocument>
               <ram:SpecifiedTradeProduct>
                    <ram:GlobalID schemeID="0160">598785412598745</ram:GlobalID>
                    <ram:Name>PRESTATION SUPPORT</ram:Name>
               </ram:SpecifiedTradeProduct>
               <ram:SpecifiedLineTradeAgreement>
                     <ram:GrossPriceProductTradePrice>
                         <ram:ChargeAmount>65.0000</ram:ChargeAmount>
                         <ram:BasisQuantity unitCode="C62">1.0000</ram:BasisQuantity>
                          <ram:AppliedTradeAllowanceCharge>
                              <ram:ChargeIndicator>
                                   <udt:Indicator>false</udt:Indicator>
                              </ram:ChargeIndicator>
                              <ram:ActualAmount>5.0000</ram:ActualAmount>
                          </ram:AppliedTradeAllowanceCharge>
                     </ram:GrossPriceProductTradePrice>
                    <ram:NetPriceProductTradePrice>
                         <ram:ChargeAmount>60.0000</ram:ChargeAmount>
                         <ram:BasisQuantity unitCode="C62">1.0000</ram:BasisQuantity>
                    </ram:NetPriceProductTradePrice>
               </ram:SpecifiedLineTradeAgreement>
               <ram:SpecifiedLineTradeDelivery>
                    <ram:BilledQuantity unitCode="C62">1.0000</ram:BilledQuantity>
               </ram:SpecifiedLineTradeDelivery>
               <ram:SpecifiedLineTradeSettlement>
                    <ram:ApplicableTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>E</ram:CategoryCode>
                         <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
                    </ram:ApplicableTradeTax>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>100</ram:ReasonCode>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeSettlementLineMonetarySummation>
                         <ram:LineTotalAmount>60.00</ram:LineTotalAmount>
                    </ram:SpecifiedTradeSettlementLineMonetarySummation>
               </ram:SpecifiedLineTradeSettlement>
          </ram:IncludedSupplyChainTradeLineItem>
          <ram:IncludedSupplyChainTradeLineItem>
               <ram:AssociatedDocumentLineDocument>
                    <ram:LineID>2</ram:LineID>
                    <ram:IncludedNote>
                         <ram:Content>DONT 0,50 EUR de DEEE</ram:Content>
                    </ram:IncludedNote>
               </ram:AssociatedDocumentLineDocument>
               <ram:SpecifiedTradeProduct>
                    <ram:Name>FOURNITURES PAPIER</ram:Name>
               </ram:SpecifiedTradeProduct>
               <ram:SpecifiedLineTradeAgreement>
                     <ram:GrossPriceProductTradePrice>
                         <ram:ChargeAmount>31.0000</ram:ChargeAmount>
                         <ram:BasisQuantity unitCode="C62">3.0000</ram:BasisQuantity>
                          <ram:AppliedTradeAllowanceCharge>
                              <ram:ChargeIndicator>
                                   <udt:Indicator>false</udt:Indicator>
                              </ram:ChargeIndicator>
                              <ram:ActualAmount>1.0000</ram:ActualAmount>
                          </ram:AppliedTradeAllowanceCharge>
                     </ram:GrossPriceProductTradePrice>
                    <ram:NetPriceProductTradePrice>
                         <ram:ChargeAmount>30.0000</ram:ChargeAmount>
                         <ram:BasisQuantity unitCode="C62">3.0000</ram:BasisQuantity>
                    </ram:NetPriceProductTradePrice>
               </ram:SpecifiedLineTradeAgreement>
               <ram:SpecifiedLineTradeDelivery>
                    <ram:BilledQuantity unitCode="C62">3.0000</ram:BilledQuantity>
               </ram:SpecifiedLineTradeDelivery>
               <ram:SpecifiedLineTradeSettlement>
                    <ram:ApplicableTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
                    </ram:ApplicableTradeTax>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>2.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>100</ram:ReasonCode>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>ADL</ram:ReasonCode>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeSettlementLineMonetarySummation>
                         <ram:LineTotalAmount>28.00</ram:LineTotalAmount>
                    </ram:SpecifiedTradeSettlementLineMonetarySummation>
               </ram:SpecifiedLineTradeSettlement>
          </ram:IncludedSupplyChainTradeLineItem>
          <ram:IncludedSupplyChainTradeLineItem>
               <ram:AssociatedDocumentLineDocument>
                    <ram:LineID>3</ram:LineID>
                    <ram:IncludedNote>
                         <ram:Content>DONT 0,50 EUR de DEEE</ram:Content>
                    </ram:IncludedNote>
               </ram:AssociatedDocumentLineDocument>
               <ram:SpecifiedTradeProduct>
                    <ram:Name>APPEL</ram:Name>
               </ram:SpecifiedTradeProduct>
               <ram:SpecifiedLineTradeAgreement>
                     <ram:GrossPriceProductTradePrice>
                         <ram:ChargeAmount>7.0000</ram:ChargeAmount>
                          <ram:AppliedTradeAllowanceCharge>
                              <ram:ChargeIndicator>
                                   <udt:Indicator>false</udt:Indicator>
                              </ram:ChargeIndicator>
                              <ram:ActualAmount>0.0000</ram:ActualAmount>
                          </ram:AppliedTradeAllowanceCharge>
                     </ram:GrossPriceProductTradePrice>
                    <ram:NetPriceProductTradePrice>
                         <ram:ChargeAmount>7.0000</ram:ChargeAmount>
                    </ram:NetPriceProductTradePrice>
               </ram:SpecifiedLineTradeAgreement>
               <ram:SpecifiedLineTradeDelivery>
                    <ram:BilledQuantity unitCode="C62">1.0000</ram:BilledQuantity>
               </ram:SpecifiedLineTradeDelivery>
               <ram:SpecifiedLineTradeSettlement>
                    <ram:ApplicableTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:ApplicableTradeTax>
                    <ram:SpecifiedTradeSettlementLineMonetarySummation>
                         <ram:LineTotalAmount>7.00</ram:LineTotalAmount>
                    </ram:SpecifiedTradeSettlementLineMonetarySummation>
               </ram:SpecifiedLineTradeSettlement>
          </ram:IncludedSupplyChainTradeLineItem>
          <ram:ApplicableHeaderTradeAgreement>
               <ram:BuyerReference>SERVEXEC</ram:BuyerReference>
               <ram:SellerTradeParty>
                    <ram:ID>123</ram:ID>
                    <ram:GlobalID schemeID="0088">587451236587</ram:GlobalID>
                    <ram:GlobalID schemeID="0009">12345678200077</ram:GlobalID>
                    <ram:GlobalID schemeID="0060">DUNS1235487</ram:GlobalID>
                    <ram:GlobalID schemeID="0177">ODETTE254879</ram:GlobalID>
                    <ram:Name>LE FOURNISSEUR</ram:Name>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">123456782</ram:ID>
                         <ram:TradingBusinessName>SELLER TRADE NAME</ram:TradingBusinessName>
                    </ram:SpecifiedLegalOrganization>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>75018</ram:PostcodeCode>
                         <ram:LineOne>35 rue d'ici</ram:LineOne>
                         <ram:LineTwo>Seller line 2</ram:LineTwo>
                         <ram:LineThree>Seller line 3</ram:LineThree>
                         <ram:CityName>PARIS</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:URIUniversalCommunication>
                         <ram:URIID schemeID="EM">moi@seller.com</ram:URIID>
                    </ram:URIUniversalCommunication>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR11123456782</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:SellerTradeParty>
               <ram:BuyerTradeParty>
                    <ram:GlobalID schemeID="0088">3654789851</ram:GlobalID>
                    <ram:Name>LE CLIENT</ram:Name>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">987654321</ram:ID>
                    </ram:SpecifiedLegalOrganization>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>06000</ram:PostcodeCode>
                         <ram:LineOne>MON ADRESSE LIGNE 1</ram:LineOne>
                         <ram:LineTwo>Buyer line 2</ram:LineTwo>
                         <ram:LineThree>Buyer line 3</ram:LineThree>
                         <ram:CityName>MA VILLE</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:URIUniversalCommunication>
                         <ram:URIID schemeID="EM">me@buyer.com</ram:URIID>
                    </ram:URIUniversalCommunication>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR 05 987 654 321</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:BuyerTradeParty>
               <ram:SellerTaxRepresentativeTradeParty>
                    <ram:Name>SELLER TAX REP</ram:Name>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>75018</ram:PostcodeCode>
                         <ram:LineOne>35 rue d'ici</ram:LineOne>
                         <ram:LineTwo>Seller line 2</ram:LineTwo>
                         <ram:LineThree>Seller line 3</ram:LineThree>
                         <ram:CityName>PARIS</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR 05 987 654 321</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:SellerTaxRepresentativeTradeParty>
               <ram:BuyerOrderReferencedDocument>
                    <ram:IssuerAssignedID>PO201925478</ram:IssuerAssignedID>
               </ram:BuyerOrderReferencedDocument>
               <ram:ContractReferencedDocument>
                    <ram:IssuerAssignedID>CT2018120802</ram:IssuerAssignedID>
               </ram:ContractReferencedDocument>
          </ram:ApplicableHeaderTradeAgreement>
          <ram:ApplicableHeaderTradeDelivery>
               <ram:ShipToTradeParty>
                    <ram:ID>PRIVATE_ID_DEL</ram:ID>
                    <ram:Name>DEL Name</ram:Name>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>06000</ram:PostcodeCode>
                         <ram:LineOne>DEL ADRESSE LIGNE 1</ram:LineOne>
                         <ram:LineTwo>DEL line 2</ram:LineTwo>
                         <ram:CityName>NICE</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
               </ram:ShipToTradeParty>
               <ram:ActualDeliverySupplyChainEvent>
                    <ram:OccurrenceDateTime>
                         <udt:DateTimeString format="102">20220128</udt:DateTimeString>
                    </ram:OccurrenceDateTime>
               </ram:ActualDeliverySupplyChainEvent>
               <ram:DespatchAdviceReferencedDocument>
                    <ram:IssuerAssignedID>DESPADV002</ram:IssuerAssignedID>
               </ram:DespatchAdviceReferencedDocument>
          </ram:ApplicableHeaderTradeDelivery>
          <ram:ApplicableHeaderTradeSettlement>
               <ram:CreditorReferenceID>CREDID</ram:CreditorReferenceID>
               <ram:PaymentReference>F20180023BUYER</ram:PaymentReference>
               <ram:InvoiceCurrencyCode>EUR</ram:InvoiceCurrencyCode>
               <ram:PayeeTradeParty>
                    <ram:GlobalID schemeID="0088">587451236586</ram:GlobalID>
                    <ram:Name>PAYEE NAME</ram:Name>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">303656847</ram:ID>
                    </ram:SpecifiedLegalOrganization>
               </ram:PayeeTradeParty>
               <ram:SpecifiedTradeSettlementPaymentMeans>
                    <ram:TypeCode>30</ram:TypeCode>
                    <ram:PayerPartyDebtorFinancialAccount>
                         <ram:IBANID>FRDEBIT</ram:IBANID>
                    </ram:PayerPartyDebtorFinancialAccount>
                    <ram:PayeePartyCreditorFinancialAccount>
                         <ram:IBANID>FR20 1254 2547 2569 8542 5874 698</ram:IBANID>
                         <ram:ProprietaryID>LOC BANK ACCOUNT</ram:ProprietaryID>
                    </ram:PayeePartyCreditorFinancialAccount>
               </ram:SpecifiedTradeSettlementPaymentMeans>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>2.20</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:BasisAmount>11.00</ram:BasisAmount>
                    <ram:CategoryCode>S</ram:CategoryCode>
                    <ram:DueDateTypeCode>72</ram:DueDateTypeCode>
                    <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>0.00</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:ExemptionReason>DEBOURS</ram:ExemptionReason>
                    <ram:BasisAmount>60.00</ram:BasisAmount>
                    <ram:CategoryCode>E</ram:CategoryCode>
                    <ram:ExemptionReasonCode>VATEX-EU-79-C</ram:ExemptionReasonCode>
                    <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>2.70</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:BasisAmount>27.00</ram:BasisAmount>
                    <ram:CategoryCode>S</ram:CategoryCode>
                    <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>0.00</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:ExemptionReason>LIVRAISON INTRACOMMUNAUTAIRE</ram:ExemptionReason>
                    <ram:BasisAmount>2.00</ram:BasisAmount>
                    <ram:CategoryCode>K</ram:CategoryCode>
                    <ram:ExemptionReasonCode>VATEX-EU-IC</ram:ExemptionReasonCode>
                    <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:BillingSpecifiedPeriod>
                    <ram:StartDateTime>
                         <udt:DateTimeString format="102">20220101</udt:DateTimeString>
                    </ram:StartDateTime>
                    <ram:EndDateTime>
                         <udt:DateTimeString format="102">20221231</udt:DateTimeString>
                    </ram:EndDateTime>
               </ram:BillingSpecifiedPeriod>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>5.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>5.00</ram:ActualAmount>
                    <ram:ReasonCode>95</ram:ReasonCode>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>100</ram:ReasonCode>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>100</ram:ReasonCode>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>2.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>2.00</ram:ActualAmount>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>10.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>10.00</ram:ActualAmount>
                    <ram:ReasonCode>FC</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>ADR</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>2.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>2.00</ram:ActualAmount>
                    <ram:ReasonCode>FC</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>K</ram:CategoryCode>
                         <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>FC</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradePaymentTerms>
                    <ram:Description>PAIEMENT 30 JOURS NET</ram:Description>
                    <ram:DueDateDateTime>
                         <udt:DateTimeString format="102">20220302</udt:DateTimeString>
                    </ram:DueDateDateTime>
                    <ram:DirectDebitMandateID>MANDATE PT</ram:DirectDebitMandateID>
               </ram:SpecifiedTradePaymentTerms>
               <ram:SpecifiedTradeSettlementHeaderMonetarySummation>
                    <ram:LineTotalAmount>95.00</ram:LineTotalAmount>
                    <ram:ChargeTotalAmount>14.00</ram:ChargeTotalAmount>
                    <ram:AllowanceTotalAmount>9.00</ram:AllowanceTotalAmount>
                    <ram:TaxBasisTotalAmount>100.00</ram:TaxBasisTotalAmount>
                    <ram:TaxTotalAmount currencyID="EUR">4.90</ram:TaxTotalAmount>
                    <ram:GrandTotalAmount>104.90</ram:GrandTotalAmount>
                    <ram:TotalPrepaidAmount>0.00</ram:TotalPrepaidAmount>
                    <ram:DuePayableAmount>104.90</ram:DuePayableAmount>
               </ram:SpecifiedTradeSettlementHeaderMonetarySummation>
               <ram:InvoiceReferencedDocument>
                    <ram:IssuerAssignedID>F20220003</ram:IssuerAssignedID>
                    <ram:FormattedIssueDateTime>
                         <qdt:DateTimeString format="102">20220101</qdt:DateTimeString>
                    </ram:FormattedIssueDateTime>
               </ram:InvoiceReferencedDocument>
               <ram:ReceivableSpecifiedTradeAccountingAccount>
                    <ram:ID>BUYER ACCOUNT REF</ram:ID>
               </ram:ReceivableSpecifiedTradeAccountingAccount>
          </ram:ApplicableHeaderTradeSettlement>
     </rsm:SupplyChainTradeTransaction>
</rsm:CrossIndustryInvoice>
XML;

        $writer = (new Writer())->generate(
            pdfContent: $pdfContent,
            xmlContent: $xml,
            addLogo: true
        );

        file_put_contents(__DIR__ . \DIRECTORY_SEPARATOR . 'basic_facturx.pdf', $writer);

        $extractedXml = (new Reader())->extractXML($writer);
        $this->assertSame($xml, $extractedXml);
    }

    public function testGenerateEN16931ProfileFacturX(): void
    {
        $pdfFilePath = __DIR__ . \DIRECTORY_SEPARATOR . 'sample.pdf';
        $pdfContent  = file_get_contents($pdfFilePath);
        \assert(\is_string($pdfContent));
        $xml = <<<XML
<?xml version='1.0' encoding='UTF-8'?>
<rsm:CrossIndustryInvoice xmlns:qdt="urn:un:unece:uncefact:data:standard:QualifiedDataType:100"
xmlns:ram="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100"
xmlns:rsm="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100"
xmlns:udt="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
     <rsm:ExchangedDocumentContext>
          <ram:BusinessProcessSpecifiedDocumentContextParameter>
               <ram:ID>A1</ram:ID>
          </ram:BusinessProcessSpecifiedDocumentContextParameter>
          <ram:GuidelineSpecifiedDocumentContextParameter>
               <ram:ID>urn:cen.eu:en16931:2017</ram:ID>
          </ram:GuidelineSpecifiedDocumentContextParameter>
     </rsm:ExchangedDocumentContext>
     <rsm:ExchangedDocument>
          <ram:ID>F20220023</ram:ID>
          <ram:TypeCode>380</ram:TypeCode>
          <ram:IssueDateTime>
               <udt:DateTimeString format="102">20220131</udt:DateTimeString>
          </ram:IssueDateTime>
          <ram:IncludedNote>
               <ram:Content>FOURNISSEUR F SARL au capital de 50 000 EUR</ram:Content>
               <ram:SubjectCode>REG</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>RCS MAVILLE 123 456 782</ram:Content>
               <ram:SubjectCode>ABL</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>35 ma rue a moi, code postal Ville Pays – contact@masociete.fr - www.masociete.fr  – N° TVA : FR32 123 456 789</ram:Content>
               <ram:SubjectCode>AAI</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>Tout retard de paiement engendre une pénalité exigible à compter de la date d'échéance, calculée sur la base de trois fois le taux d'intérêt légal. </ram:Content>
               <ram:SubjectCode>PMD</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>Indemnité forfaitaire pour frais de recouvrement en cas de retard de paiement : 40 €.</ram:Content>
               <ram:SubjectCode>PMT</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>Les réglements reçus avant la date d'échéance ne donneront pas lieu à escompte.</ram:Content>
               <ram:SubjectCode>AAB</ram:SubjectCode>
          </ram:IncludedNote>
     </rsm:ExchangedDocument>
     <rsm:SupplyChainTradeTransaction>
          <ram:IncludedSupplyChainTradeLineItem>
               <ram:AssociatedDocumentLineDocument>
                    <ram:LineID>1</ram:LineID>
                    <ram:IncludedNote>
                         <ram:Content>DONT 0,50 EUR de DEEE</ram:Content>
                    </ram:IncludedNote>
               </ram:AssociatedDocumentLineDocument>
               <ram:SpecifiedTradeProduct>
                    <ram:GlobalID schemeID="0160">598785412598745</ram:GlobalID>
                    <ram:SellerAssignedID>ART_1254</ram:SellerAssignedID>
                    <ram:BuyerAssignedID>REF5487</ram:BuyerAssignedID>
                    <ram:Name>PRESTATION SUPPORT</ram:Name>
                    <ram:Description>Description</ram:Description>
                    <ram:ApplicableProductCharacteristic>
                         <ram:Description>CATEGORIE</ram:Description>
                         <ram:Value>JOUR 8H-20H</ram:Value>
                    </ram:ApplicableProductCharacteristic>
                    <ram:DesignatedProductClassification>
                         <ram:ClassCode listID="SK">SKU2578</ram:ClassCode>
                    </ram:DesignatedProductClassification>
               </ram:SpecifiedTradeProduct>
               <ram:SpecifiedLineTradeAgreement>
                    <ram:BuyerOrderReferencedDocument>
                         <ram:LineID>1</ram:LineID>
                    </ram:BuyerOrderReferencedDocument>
                     <ram:GrossPriceProductTradePrice>
                         <ram:ChargeAmount>65.0000</ram:ChargeAmount>
                         <ram:BasisQuantity unitCode="C62">1.0000</ram:BasisQuantity>
                          <ram:AppliedTradeAllowanceCharge>
                              <ram:ChargeIndicator>
                                   <udt:Indicator>false</udt:Indicator>
                              </ram:ChargeIndicator>
                              <ram:ActualAmount>5.0000</ram:ActualAmount>
                          </ram:AppliedTradeAllowanceCharge>
                     </ram:GrossPriceProductTradePrice>
                    <ram:NetPriceProductTradePrice>
                         <ram:ChargeAmount>60.0000</ram:ChargeAmount>
                         <ram:BasisQuantity unitCode="C62">1.0000</ram:BasisQuantity>
                    </ram:NetPriceProductTradePrice>
               </ram:SpecifiedLineTradeAgreement>
               <ram:SpecifiedLineTradeDelivery>
                    <ram:BilledQuantity unitCode="C62">1.0000</ram:BilledQuantity>
               </ram:SpecifiedLineTradeDelivery>
               <ram:SpecifiedLineTradeSettlement>
                    <ram:ApplicableTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>E</ram:CategoryCode>
                         <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
                    </ram:ApplicableTradeTax>
                    <ram:BillingSpecifiedPeriod>
                         <ram:StartDateTime>
                              <udt:DateTimeString format="102">20220101</udt:DateTimeString>
                         </ram:StartDateTime>
                         <ram:EndDateTime>
                              <udt:DateTimeString format="102">20220131</udt:DateTimeString>
                         </ram:EndDateTime>
                    </ram:BillingSpecifiedPeriod>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:CalculationPercent>1.00</ram:CalculationPercent>
                         <ram:BasisAmount>100.00</ram:BasisAmount>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>100</ram:ReasonCode>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeSettlementLineMonetarySummation>
                         <ram:LineTotalAmount>60.00</ram:LineTotalAmount>
                    </ram:SpecifiedTradeSettlementLineMonetarySummation>
                    <ram:AdditionalReferencedDocument>
                         <ram:IssuerAssignedID>EQUIPE_A</ram:IssuerAssignedID>
                          <ram:TypeCode>130</ram:TypeCode>
                         <ram:ReferenceTypeCode>AOP</ram:ReferenceTypeCode>
                    </ram:AdditionalReferencedDocument>
                    <ram:ReceivableSpecifiedTradeAccountingAccount>
                         <ram:ID>BUY_ACC_REF</ram:ID>
                    </ram:ReceivableSpecifiedTradeAccountingAccount>
               </ram:SpecifiedLineTradeSettlement>
          </ram:IncludedSupplyChainTradeLineItem>
          <ram:IncludedSupplyChainTradeLineItem>
               <ram:AssociatedDocumentLineDocument>
                    <ram:LineID>2</ram:LineID>
                    <ram:IncludedNote>
                         <ram:Content>DONT 0,50 EUR de DEEE</ram:Content>
                    </ram:IncludedNote>
               </ram:AssociatedDocumentLineDocument>
               <ram:SpecifiedTradeProduct>
                    <ram:SellerAssignedID>ART_9874</ram:SellerAssignedID>
                    <ram:BuyerAssignedID>REF9854</ram:BuyerAssignedID>
                    <ram:Name>FOURNITURES PAPIER</ram:Name>
                    <ram:Description>Description</ram:Description>
                    <ram:ApplicableProductCharacteristic>
                         <ram:Description>COULEUR</ram:Description>
                         <ram:Value>BLANC</ram:Value>
                    </ram:ApplicableProductCharacteristic>
                    <ram:ApplicableProductCharacteristic>
                         <ram:Description>GRAMMAGE</ram:Description>
                         <ram:Value>80g</ram:Value>
                    </ram:ApplicableProductCharacteristic>
                    <ram:DesignatedProductClassification>
                         <ram:ClassCode listID="BB">LOT6254784</ram:ClassCode>
                    </ram:DesignatedProductClassification>
                    <ram:OriginTradeCountry>
                         <ram:ID>FR</ram:ID>
                    </ram:OriginTradeCountry>
               </ram:SpecifiedTradeProduct>
               <ram:SpecifiedLineTradeAgreement>
                    <ram:BuyerOrderReferencedDocument>
                         <ram:LineID>3</ram:LineID>
                    </ram:BuyerOrderReferencedDocument>
                     <ram:GrossPriceProductTradePrice>
                         <ram:ChargeAmount>31.0000</ram:ChargeAmount>
                         <ram:BasisQuantity unitCode="C62">3.0000</ram:BasisQuantity>
                          <ram:AppliedTradeAllowanceCharge>
                              <ram:ChargeIndicator>
                                   <udt:Indicator>false</udt:Indicator>
                              </ram:ChargeIndicator>
                              <ram:ActualAmount>1.0000</ram:ActualAmount>
                          </ram:AppliedTradeAllowanceCharge>
                     </ram:GrossPriceProductTradePrice>
                    <ram:NetPriceProductTradePrice>
                         <ram:ChargeAmount>30.0000</ram:ChargeAmount>
                         <ram:BasisQuantity unitCode="C62">3.0000</ram:BasisQuantity>
                    </ram:NetPriceProductTradePrice>
               </ram:SpecifiedLineTradeAgreement>
               <ram:SpecifiedLineTradeDelivery>
                    <ram:BilledQuantity unitCode="C62">3.0000</ram:BilledQuantity>
               </ram:SpecifiedLineTradeDelivery>
               <ram:SpecifiedLineTradeSettlement>
                    <ram:ApplicableTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
                    </ram:ApplicableTradeTax>
                    <ram:BillingSpecifiedPeriod>
                         <ram:StartDateTime>
                              <udt:DateTimeString format="102">20220101</udt:DateTimeString>
                         </ram:StartDateTime>
                         <ram:EndDateTime>
                              <udt:DateTimeString format="102">20220131</udt:DateTimeString>
                         </ram:EndDateTime>
                    </ram:BillingSpecifiedPeriod>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>2.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>100</ram:ReasonCode>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>ADL</ram:ReasonCode>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeSettlementLineMonetarySummation>
                         <ram:LineTotalAmount>28.00</ram:LineTotalAmount>
                    </ram:SpecifiedTradeSettlementLineMonetarySummation>
                    <ram:AdditionalReferencedDocument>
                         <ram:IssuerAssignedID>TARIF_2022</ram:IssuerAssignedID>
                          <ram:TypeCode>130</ram:TypeCode>
                         <ram:ReferenceTypeCode>AFG</ram:ReferenceTypeCode>
                    </ram:AdditionalReferencedDocument>
                    <ram:ReceivableSpecifiedTradeAccountingAccount>
                         <ram:ID>BUY_ACC_REF</ram:ID>
                    </ram:ReceivableSpecifiedTradeAccountingAccount>
               </ram:SpecifiedLineTradeSettlement>
          </ram:IncludedSupplyChainTradeLineItem>
          <ram:IncludedSupplyChainTradeLineItem>
               <ram:AssociatedDocumentLineDocument>
                    <ram:LineID>3</ram:LineID>
                    <ram:IncludedNote>
                         <ram:Content>DONT 0,50 EUR de DEEE</ram:Content>
                    </ram:IncludedNote>
               </ram:AssociatedDocumentLineDocument>
               <ram:SpecifiedTradeProduct>
                    <ram:Name>APPEL</ram:Name>
                    <ram:Description>Description</ram:Description>
               </ram:SpecifiedTradeProduct>
               <ram:SpecifiedLineTradeAgreement>
                    <ram:BuyerOrderReferencedDocument>
                         <ram:LineID>2</ram:LineID>
                    </ram:BuyerOrderReferencedDocument>
                     <ram:GrossPriceProductTradePrice>
                         <ram:ChargeAmount>7.0000</ram:ChargeAmount>
                          <ram:AppliedTradeAllowanceCharge>
                              <ram:ChargeIndicator>
                                   <udt:Indicator>false</udt:Indicator>
                              </ram:ChargeIndicator>
                              <ram:ActualAmount>0.0000</ram:ActualAmount>
                          </ram:AppliedTradeAllowanceCharge>
                     </ram:GrossPriceProductTradePrice>
                    <ram:NetPriceProductTradePrice>
                         <ram:ChargeAmount>7.0000</ram:ChargeAmount>
                    </ram:NetPriceProductTradePrice>
               </ram:SpecifiedLineTradeAgreement>
               <ram:SpecifiedLineTradeDelivery>
                    <ram:BilledQuantity unitCode="C62">1.0000</ram:BilledQuantity>
               </ram:SpecifiedLineTradeDelivery>
               <ram:SpecifiedLineTradeSettlement>
                    <ram:ApplicableTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:ApplicableTradeTax>
                    <ram:SpecifiedTradeSettlementLineMonetarySummation>
                         <ram:LineTotalAmount>7.00</ram:LineTotalAmount>
                    </ram:SpecifiedTradeSettlementLineMonetarySummation>
                    <ram:ReceivableSpecifiedTradeAccountingAccount>
                         <ram:ID>BUY_ACC_REF</ram:ID>
                    </ram:ReceivableSpecifiedTradeAccountingAccount>
               </ram:SpecifiedLineTradeSettlement>
          </ram:IncludedSupplyChainTradeLineItem>
          <ram:ApplicableHeaderTradeAgreement>
               <ram:BuyerReference>SERVEXEC</ram:BuyerReference>
               <ram:SellerTradeParty>
                    <ram:ID>123</ram:ID>
                    <ram:GlobalID schemeID="0088">587451236587</ram:GlobalID>
                    <ram:GlobalID schemeID="0009">12345678200077</ram:GlobalID>
                    <ram:GlobalID schemeID="0060">DUNS1235487</ram:GlobalID>
                    <ram:GlobalID schemeID="0177">ODETTE254879</ram:GlobalID>
                    <ram:Name>LE FOURNISSEUR</ram:Name>
                    <ram:Description>SARL AU CAPITAL DE 50 000 EUROS</ram:Description>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">123456782</ram:ID>
                         <ram:TradingBusinessName>SELLER TRADE NAME</ram:TradingBusinessName>
                    </ram:SpecifiedLegalOrganization>
                    <ram:DefinedTradeContact>
                         <ram:PersonName>M. CONTACT</ram:PersonName>
                         <ram:DepartmentName>DEP SELLER</ram:DepartmentName>
                         <ram:TelephoneUniversalCommunication>
                              <ram:CompleteNumber>01 02 03 54 87</ram:CompleteNumber>
                         </ram:TelephoneUniversalCommunication>
                         <ram:EmailURIUniversalCommunication>
                              <ram:URIID>seller@seller.com</ram:URIID>
                         </ram:EmailURIUniversalCommunication>
                    </ram:DefinedTradeContact>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>75018</ram:PostcodeCode>
                         <ram:LineOne>35 rue d'ici</ram:LineOne>
                         <ram:LineTwo>Seller line 2</ram:LineTwo>
                         <ram:LineThree>Seller line 3</ram:LineThree>
                         <ram:CityName>PARIS</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:URIUniversalCommunication>
                         <ram:URIID schemeID="EM">moi@seller.com</ram:URIID>
                    </ram:URIUniversalCommunication>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR11123456782</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:SellerTradeParty>
               <ram:BuyerTradeParty>
                    <ram:GlobalID schemeID="0088">3654789851</ram:GlobalID>
                    <ram:Name>LE CLIENT</ram:Name>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">987654321</ram:ID>
                    </ram:SpecifiedLegalOrganization>
                    <ram:DefinedTradeContact>
                         <ram:PersonName>Buyer contact name</ram:PersonName>
                         <ram:DepartmentName>Buyer dep</ram:DepartmentName>
                         <ram:TelephoneUniversalCommunication>
                              <ram:CompleteNumber>01 01 25 45 87</ram:CompleteNumber>
                         </ram:TelephoneUniversalCommunication>
                         <ram:EmailURIUniversalCommunication>
                              <ram:URIID>buyer@buyer.com</ram:URIID>
                         </ram:EmailURIUniversalCommunication>
                    </ram:DefinedTradeContact>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>06000</ram:PostcodeCode>
                         <ram:LineOne>MON ADRESSE LIGNE 1</ram:LineOne>
                         <ram:LineTwo>Buyer line 2</ram:LineTwo>
                         <ram:LineThree>Buyer line 3</ram:LineThree>
                         <ram:CityName>MA VILLE</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:URIUniversalCommunication>
                         <ram:URIID schemeID="EM">me@buyer.com</ram:URIID>
                    </ram:URIUniversalCommunication>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR 05 987 654 321</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:BuyerTradeParty>
               <ram:SellerTaxRepresentativeTradeParty>
                    <ram:Name>SELLER TAX REP</ram:Name>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>75018</ram:PostcodeCode>
                         <ram:LineOne>35 rue d'ici</ram:LineOne>
                         <ram:LineTwo>Seller line 2</ram:LineTwo>
                         <ram:LineThree>Seller line 3</ram:LineThree>
                         <ram:CityName>PARIS</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR 05 987 654 321</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:SellerTaxRepresentativeTradeParty>
               <ram:SellerOrderReferencedDocument>
                    <ram:IssuerAssignedID>SALES REF 2547</ram:IssuerAssignedID>
               </ram:SellerOrderReferencedDocument>
               <ram:BuyerOrderReferencedDocument>
                    <ram:IssuerAssignedID>PO201925478</ram:IssuerAssignedID>
               </ram:BuyerOrderReferencedDocument>
               <ram:ContractReferencedDocument>
                    <ram:IssuerAssignedID>CT2018120802</ram:IssuerAssignedID>
               </ram:ContractReferencedDocument>
               <ram:AdditionalReferencedDocument>
                    <ram:IssuerAssignedID>SUPPort doc</ram:IssuerAssignedID>
                    <ram:URIID>url:gffter</ram:URIID>
                    <ram:TypeCode>916</ram:TypeCode>
                    <ram:Name>support descript</ram:Name>
               </ram:AdditionalReferencedDocument>
               <ram:AdditionalReferencedDocument>
                    <ram:IssuerAssignedID>TENDER-002</ram:IssuerAssignedID>
                    <ram:TypeCode>50</ram:TypeCode>
               </ram:AdditionalReferencedDocument>
               <ram:AdditionalReferencedDocument>
                    <ram:IssuerAssignedID>REFCLI0215</ram:IssuerAssignedID>
                    <ram:TypeCode>130</ram:TypeCode>
                    <ram:ReferenceTypeCode>IT</ram:ReferenceTypeCode>
               </ram:AdditionalReferencedDocument>
               <ram:SpecifiedProcuringProject>
                    <ram:ID>PROJET2547</ram:ID>
                    <ram:Name>Project reference</ram:Name>
               </ram:SpecifiedProcuringProject>
          </ram:ApplicableHeaderTradeAgreement>
          <ram:ApplicableHeaderTradeDelivery>
               <ram:ShipToTradeParty>
                    <ram:ID>PRIVATE_ID_DEL</ram:ID>
                    <ram:Name>DEL Name</ram:Name>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>06000</ram:PostcodeCode>
                         <ram:LineOne>DEL ADRESSE LIGNE 1</ram:LineOne>
                         <ram:LineTwo>DEL line 2</ram:LineTwo>
                         <ram:CityName>NICE</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
               </ram:ShipToTradeParty>
               <ram:ActualDeliverySupplyChainEvent>
                    <ram:OccurrenceDateTime>
                         <udt:DateTimeString format="102">20220128</udt:DateTimeString>
                    </ram:OccurrenceDateTime>
               </ram:ActualDeliverySupplyChainEvent>
               <ram:DespatchAdviceReferencedDocument>
                    <ram:IssuerAssignedID>DESPADV002</ram:IssuerAssignedID>
               </ram:DespatchAdviceReferencedDocument>
               <ram:ReceivingAdviceReferencedDocument>
                    <ram:IssuerAssignedID>RECEIV-ADV002</ram:IssuerAssignedID>
               </ram:ReceivingAdviceReferencedDocument>
          </ram:ApplicableHeaderTradeDelivery>
          <ram:ApplicableHeaderTradeSettlement>
               <ram:CreditorReferenceID>CREDID</ram:CreditorReferenceID>
               <ram:PaymentReference>F20180023BUYER</ram:PaymentReference>
               <ram:InvoiceCurrencyCode>EUR</ram:InvoiceCurrencyCode>
               <ram:PayeeTradeParty>
                    <ram:GlobalID schemeID="0088">587451236586</ram:GlobalID>
                    <ram:Name>PAYEE NAME</ram:Name>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">303656847</ram:ID>
                    </ram:SpecifiedLegalOrganization>
               </ram:PayeeTradeParty>
               <ram:SpecifiedTradeSettlementPaymentMeans>
                    <ram:TypeCode>30</ram:TypeCode>
                    <ram:Information>Virement</ram:Information>
                    <ram:PayerPartyDebtorFinancialAccount>
                         <ram:IBANID>FRDEBIT</ram:IBANID>
                    </ram:PayerPartyDebtorFinancialAccount>
                    <ram:PayeePartyCreditorFinancialAccount>
                         <ram:IBANID>FR20 1254 2547 2569 8542 5874 698</ram:IBANID>
                         <ram:AccountName>MON COMPTE BANCAIRE</ram:AccountName>
                         <ram:ProprietaryID>LOC BANK ACCOUNT</ram:ProprietaryID>
                    </ram:PayeePartyCreditorFinancialAccount>
                    <ram:PayeeSpecifiedCreditorFinancialInstitution>
                         <ram:BICID>BIC_MONCOMPTE</ram:BICID>
                    </ram:PayeeSpecifiedCreditorFinancialInstitution>
               </ram:SpecifiedTradeSettlementPaymentMeans>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>2.20</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:BasisAmount>11.00</ram:BasisAmount>
                    <ram:CategoryCode>S</ram:CategoryCode>
                    <ram:DueDateTypeCode>72</ram:DueDateTypeCode>
                    <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>0.00</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:ExemptionReason>DEBOURS</ram:ExemptionReason>
                    <ram:BasisAmount>60.00</ram:BasisAmount>
                    <ram:CategoryCode>E</ram:CategoryCode>
                    <ram:ExemptionReasonCode>VATEX-EU-79-C</ram:ExemptionReasonCode>
                    <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>2.70</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:BasisAmount>27.00</ram:BasisAmount>
                    <ram:CategoryCode>S</ram:CategoryCode>
                    <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>0.00</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:ExemptionReason>LIVRAISON INTRACOMMUNAUTAIRE</ram:ExemptionReason>
                    <ram:BasisAmount>2.00</ram:BasisAmount>
                    <ram:CategoryCode>K</ram:CategoryCode>
                    <ram:ExemptionReasonCode>VATEX-EU-IC</ram:ExemptionReasonCode>
                    <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:BillingSpecifiedPeriod>
                    <ram:StartDateTime>
                         <udt:DateTimeString format="102">20220101</udt:DateTimeString>
                    </ram:StartDateTime>
                    <ram:EndDateTime>
                         <udt:DateTimeString format="102">20221231</udt:DateTimeString>
                    </ram:EndDateTime>
               </ram:BillingSpecifiedPeriod>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>5.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>5.00</ram:ActualAmount>
                    <ram:ReasonCode>95</ram:ReasonCode>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>100</ram:ReasonCode>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>100</ram:ReasonCode>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>2.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>2.00</ram:ActualAmount>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>10.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>10.00</ram:ActualAmount>
                    <ram:ReasonCode>FC</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>ADR</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>2.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>2.00</ram:ActualAmount>
                    <ram:ReasonCode>FC</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>K</ram:CategoryCode>
                         <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>FC</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradePaymentTerms>
                    <ram:Description>PAIEMENT 30 JOURS NET</ram:Description>
                    <ram:DueDateDateTime>
                         <udt:DateTimeString format="102">20220302</udt:DateTimeString>
                    </ram:DueDateDateTime>
                    <ram:DirectDebitMandateID>MANDATE PT</ram:DirectDebitMandateID>
               </ram:SpecifiedTradePaymentTerms>
               <ram:SpecifiedTradeSettlementHeaderMonetarySummation>
                    <ram:LineTotalAmount>95.00</ram:LineTotalAmount>
                    <ram:ChargeTotalAmount>14.00</ram:ChargeTotalAmount>
                    <ram:AllowanceTotalAmount>9.00</ram:AllowanceTotalAmount>
                    <ram:TaxBasisTotalAmount>100.00</ram:TaxBasisTotalAmount>
                    <ram:TaxTotalAmount currencyID="EUR">4.90</ram:TaxTotalAmount>
                     <ram:RoundingAmount>0.00</ram:RoundingAmount>
                    <ram:GrandTotalAmount>104.90</ram:GrandTotalAmount>
                    <ram:TotalPrepaidAmount>0.00</ram:TotalPrepaidAmount>
                    <ram:DuePayableAmount>104.90</ram:DuePayableAmount>
               </ram:SpecifiedTradeSettlementHeaderMonetarySummation>
               <ram:InvoiceReferencedDocument>
                    <ram:IssuerAssignedID>F20220003</ram:IssuerAssignedID>
                    <ram:FormattedIssueDateTime>
                         <qdt:DateTimeString format="102">20220101</qdt:DateTimeString>
                    </ram:FormattedIssueDateTime>
               </ram:InvoiceReferencedDocument>
               <ram:ReceivableSpecifiedTradeAccountingAccount>
                    <ram:ID>BUYER ACCOUNT REF</ram:ID>
               </ram:ReceivableSpecifiedTradeAccountingAccount>
          </ram:ApplicableHeaderTradeSettlement>
     </rsm:SupplyChainTradeTransaction>
</rsm:CrossIndustryInvoice>
XML;

        $writer = (new Writer())->generate(
            pdfContent: $pdfContent,
            xmlContent: $xml,
            addLogo: true
        );

        file_put_contents(__DIR__ . \DIRECTORY_SEPARATOR . 'en16931_facturx.pdf', $writer);

        $extractedXml = (new Reader())->extractXML($writer);
        $this->assertSame($xml, $extractedXml);
    }

    public function testGenerateExtendedProfileFacturX(): void
    {
        $pdfFilePath = __DIR__ . \DIRECTORY_SEPARATOR . 'sample.pdf';
        $pdfContent  = file_get_contents($pdfFilePath);
        \assert(\is_string($pdfContent));
        $xml = <<<XML
<?xml version='1.0' encoding='UTF-8'?>
<rsm:CrossIndustryInvoice xmlns:qdt="urn:un:unece:uncefact:data:standard:QualifiedDataType:100"
xmlns:ram="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100"
xmlns:rsm="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100"
xmlns:udt="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
     <rsm:ExchangedDocumentContext>
          <ram:BusinessProcessSpecifiedDocumentContextParameter>
               <ram:ID>A1</ram:ID>
          </ram:BusinessProcessSpecifiedDocumentContextParameter>
          <ram:GuidelineSpecifiedDocumentContextParameter>
               <ram:ID>urn:cen.eu:en16931:2017#conformant#urn:factur-x.eu:1p0:extended</ram:ID>
          </ram:GuidelineSpecifiedDocumentContextParameter>
     </rsm:ExchangedDocumentContext>
     <rsm:ExchangedDocument>
          <ram:ID>F20220023</ram:ID>
          <ram:TypeCode>380</ram:TypeCode>
          <ram:IssueDateTime>
               <udt:DateTimeString format="102">20220131</udt:DateTimeString>
          </ram:IssueDateTime>
          <ram:IncludedNote>
               <ram:Content>FOURNISSEUR F SARL au capital de 50 000 EUR</ram:Content>
               <ram:SubjectCode>REG</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>RCS MAVILLE 123 456 782</ram:Content>
               <ram:SubjectCode>ABL</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>35 ma rue a moi, code postal Ville Pays – contact@masociete.fr - www.masociete.fr  – N° TVA : FR32 123 456 789</ram:Content>
               <ram:SubjectCode>AAI</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>Tout retard de paiement engendre une pénalité exigible à compter de la date d'échéance, calculée sur la base de trois fois le taux d'intérêt légal. </ram:Content>
               <ram:SubjectCode>PMD</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>Indemnité forfaitaire pour frais de recouvrement en cas de retard de paiement : 40 €.</ram:Content>
               <ram:SubjectCode>PMT</ram:SubjectCode>
          </ram:IncludedNote>
          <ram:IncludedNote>
               <ram:Content>Les réglements reçus avant la date d'échéance ne donneront pas lieu à escompte.</ram:Content>
               <ram:SubjectCode>AAB</ram:SubjectCode>
          </ram:IncludedNote>
     </rsm:ExchangedDocument>
     <rsm:SupplyChainTradeTransaction>
          <ram:IncludedSupplyChainTradeLineItem>
               <ram:AssociatedDocumentLineDocument>
                    <ram:LineID>1</ram:LineID>
                    <ram:IncludedNote>
                         <ram:Content>DONT 0,50 EUR de DEEE</ram:Content>
                         <ram:SubjectCode>BLU</ram:SubjectCode>
                    </ram:IncludedNote>
                    <ram:IncludedNote>
                         <ram:Content>AUTRE NOTE</ram:Content>
                         <ram:SubjectCode>SUR</ram:SubjectCode>
                    </ram:IncludedNote>
               </ram:AssociatedDocumentLineDocument>
               <ram:SpecifiedTradeProduct>
                    <ram:GlobalID schemeID="0160">598785412598745</ram:GlobalID>
                    <ram:SellerAssignedID>ART_1254</ram:SellerAssignedID>
                    <ram:BuyerAssignedID>REF5487</ram:BuyerAssignedID>
                    <ram:Name>PRESTATION SUPPORT</ram:Name>
                    <ram:Description>Description</ram:Description>
                    <ram:ApplicableProductCharacteristic>
                         <ram:Description>CATEGORIE</ram:Description>
                         <ram:Value>JOUR 8H-20H</ram:Value>
                    </ram:ApplicableProductCharacteristic>
                    <ram:DesignatedProductClassification>
                         <ram:ClassCode listID="SK">SKU2578</ram:ClassCode>
                    </ram:DesignatedProductClassification>
               </ram:SpecifiedTradeProduct>
               <ram:SpecifiedLineTradeAgreement>
                    <ram:BuyerOrderReferencedDocument>
                         <ram:LineID>1</ram:LineID>
                    </ram:BuyerOrderReferencedDocument>
                     <ram:GrossPriceProductTradePrice>
                         <ram:ChargeAmount>65.0000</ram:ChargeAmount>
                         <ram:BasisQuantity unitCode="C62">1.0000</ram:BasisQuantity>
                          <ram:AppliedTradeAllowanceCharge>
                              <ram:ChargeIndicator>
                                   <udt:Indicator>false</udt:Indicator>
                              </ram:ChargeIndicator>
                              <ram:ActualAmount>5.0000</ram:ActualAmount>
                          </ram:AppliedTradeAllowanceCharge>
                     </ram:GrossPriceProductTradePrice>
                    <ram:NetPriceProductTradePrice>
                         <ram:ChargeAmount>60.0000</ram:ChargeAmount>
                         <ram:BasisQuantity unitCode="C62">1.0000</ram:BasisQuantity>
                    </ram:NetPriceProductTradePrice>
               </ram:SpecifiedLineTradeAgreement>
               <ram:SpecifiedLineTradeDelivery>
                    <ram:BilledQuantity unitCode="C62">1.0000</ram:BilledQuantity>
               </ram:SpecifiedLineTradeDelivery>
               <ram:SpecifiedLineTradeSettlement>
                    <ram:ApplicableTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>E</ram:CategoryCode>
                         <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
                    </ram:ApplicableTradeTax>
                    <ram:BillingSpecifiedPeriod>
                         <ram:StartDateTime>
                              <udt:DateTimeString format="102">20220101</udt:DateTimeString>
                         </ram:StartDateTime>
                         <ram:EndDateTime>
                              <udt:DateTimeString format="102">20220131</udt:DateTimeString>
                         </ram:EndDateTime>
                    </ram:BillingSpecifiedPeriod>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:CalculationPercent>1.00</ram:CalculationPercent>
                         <ram:BasisAmount>100.00</ram:BasisAmount>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>100</ram:ReasonCode>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeSettlementLineMonetarySummation>
                         <ram:LineTotalAmount>60.00</ram:LineTotalAmount>
                    </ram:SpecifiedTradeSettlementLineMonetarySummation>
                    <ram:AdditionalReferencedDocument>
                         <ram:IssuerAssignedID>EQUIPE_A</ram:IssuerAssignedID>
                          <ram:TypeCode>130</ram:TypeCode>
                         <ram:ReferenceTypeCode>AOP</ram:ReferenceTypeCode>
                    </ram:AdditionalReferencedDocument>
                    <ram:ReceivableSpecifiedTradeAccountingAccount>
                         <ram:ID>BUY_ACC_REF</ram:ID>
                    </ram:ReceivableSpecifiedTradeAccountingAccount>
               </ram:SpecifiedLineTradeSettlement>
          </ram:IncludedSupplyChainTradeLineItem>
          <ram:IncludedSupplyChainTradeLineItem>
               <ram:AssociatedDocumentLineDocument>
                    <ram:LineID>2</ram:LineID>
                    <ram:IncludedNote>
                         <ram:Content>DONT 0,50 EUR de DEEE</ram:Content>
                         <ram:SubjectCode>BLU</ram:SubjectCode>
                    </ram:IncludedNote>
                    <ram:IncludedNote>
                         <ram:Content>AUTRE NOTE</ram:Content>
                         <ram:SubjectCode>SUR</ram:SubjectCode>
                    </ram:IncludedNote>
               </ram:AssociatedDocumentLineDocument>
               <ram:SpecifiedTradeProduct>
                    <ram:SellerAssignedID>ART_9874</ram:SellerAssignedID>
                    <ram:BuyerAssignedID>REF9854</ram:BuyerAssignedID>
                    <ram:Name>FOURNITURES PAPIER</ram:Name>
                    <ram:Description>Description</ram:Description>
                    <ram:ApplicableProductCharacteristic>
                         <ram:Description>COULEUR</ram:Description>
                         <ram:Value>BLANC</ram:Value>
                    </ram:ApplicableProductCharacteristic>
                    <ram:ApplicableProductCharacteristic>
                         <ram:Description>GRAMMAGE</ram:Description>
                         <ram:Value>80g</ram:Value>
                    </ram:ApplicableProductCharacteristic>
                    <ram:DesignatedProductClassification>
                         <ram:ClassCode listID="BB">LOT6254784</ram:ClassCode>
                    </ram:DesignatedProductClassification>
                    <ram:OriginTradeCountry>
                         <ram:ID>FR</ram:ID>
                    </ram:OriginTradeCountry>
               </ram:SpecifiedTradeProduct>
               <ram:SpecifiedLineTradeAgreement>
                    <ram:BuyerOrderReferencedDocument>
                         <ram:LineID>3</ram:LineID>
                    </ram:BuyerOrderReferencedDocument>
                     <ram:GrossPriceProductTradePrice>
                         <ram:ChargeAmount>31.0000</ram:ChargeAmount>
                         <ram:BasisQuantity unitCode="C62">3.0000</ram:BasisQuantity>
                          <ram:AppliedTradeAllowanceCharge>
                              <ram:ChargeIndicator>
                                   <udt:Indicator>false</udt:Indicator>
                              </ram:ChargeIndicator>
                              <ram:ActualAmount>1.0000</ram:ActualAmount>
                          </ram:AppliedTradeAllowanceCharge>
                     </ram:GrossPriceProductTradePrice>
                    <ram:NetPriceProductTradePrice>
                         <ram:ChargeAmount>30.0000</ram:ChargeAmount>
                         <ram:BasisQuantity unitCode="C62">3.0000</ram:BasisQuantity>
                    </ram:NetPriceProductTradePrice>
               </ram:SpecifiedLineTradeAgreement>
               <ram:SpecifiedLineTradeDelivery>
                    <ram:BilledQuantity unitCode="C62">3.0000</ram:BilledQuantity>
               </ram:SpecifiedLineTradeDelivery>
               <ram:SpecifiedLineTradeSettlement>
                    <ram:ApplicableTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
                    </ram:ApplicableTradeTax>
                    <ram:BillingSpecifiedPeriod>
                         <ram:StartDateTime>
                              <udt:DateTimeString format="102">20220101</udt:DateTimeString>
                         </ram:StartDateTime>
                         <ram:EndDateTime>
                              <udt:DateTimeString format="102">20220131</udt:DateTimeString>
                         </ram:EndDateTime>
                    </ram:BillingSpecifiedPeriod>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>2.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>71</ram:ReasonCode>
                         <ram:Reason>REMISE VOLUME</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>false</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>100</ram:ReasonCode>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:ReasonCode>ADL</ram:ReasonCode>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeAllowanceCharge>
                         <ram:ChargeIndicator>
                              <udt:Indicator>true</udt:Indicator>
                         </ram:ChargeIndicator>
                         <ram:ActualAmount>1.00</ram:ActualAmount>
                         <ram:Reason>FRAIS PALETTE</ram:Reason>
                    </ram:SpecifiedTradeAllowanceCharge>
                    <ram:SpecifiedTradeSettlementLineMonetarySummation>
                         <ram:LineTotalAmount>28.00</ram:LineTotalAmount>
                    </ram:SpecifiedTradeSettlementLineMonetarySummation>
                    <ram:AdditionalReferencedDocument>
                         <ram:IssuerAssignedID>TARIF_2022</ram:IssuerAssignedID>
                          <ram:TypeCode>130</ram:TypeCode>
                         <ram:ReferenceTypeCode>AFG</ram:ReferenceTypeCode>
                    </ram:AdditionalReferencedDocument>
                    <ram:ReceivableSpecifiedTradeAccountingAccount>
                         <ram:ID>BUY_ACC_REF</ram:ID>
                    </ram:ReceivableSpecifiedTradeAccountingAccount>
               </ram:SpecifiedLineTradeSettlement>
          </ram:IncludedSupplyChainTradeLineItem>
          <ram:IncludedSupplyChainTradeLineItem>
               <ram:AssociatedDocumentLineDocument>
                    <ram:LineID>3</ram:LineID>
                    <ram:IncludedNote>
                         <ram:Content>DONT 0,50 EUR de DEEE</ram:Content>
                         <ram:SubjectCode>BLU</ram:SubjectCode>
                    </ram:IncludedNote>
                    <ram:IncludedNote>
                         <ram:Content>AUTRE NOTE</ram:Content>
                         <ram:SubjectCode>SUR</ram:SubjectCode>
                    </ram:IncludedNote>
               </ram:AssociatedDocumentLineDocument>
               <ram:SpecifiedTradeProduct>
                    <ram:Name>APPEL</ram:Name>
                    <ram:Description>Description</ram:Description>
               </ram:SpecifiedTradeProduct>
               <ram:SpecifiedLineTradeAgreement>
                    <ram:BuyerOrderReferencedDocument>
                         <ram:LineID>2</ram:LineID>
                    </ram:BuyerOrderReferencedDocument>
                     <ram:GrossPriceProductTradePrice>
                         <ram:ChargeAmount>7.0000</ram:ChargeAmount>
                          <ram:AppliedTradeAllowanceCharge>
                              <ram:ChargeIndicator>
                                   <udt:Indicator>false</udt:Indicator>
                              </ram:ChargeIndicator>
                              <ram:ActualAmount>0.0000</ram:ActualAmount>
                          </ram:AppliedTradeAllowanceCharge>
                     </ram:GrossPriceProductTradePrice>
                    <ram:NetPriceProductTradePrice>
                         <ram:ChargeAmount>7.0000</ram:ChargeAmount>
                    </ram:NetPriceProductTradePrice>
               </ram:SpecifiedLineTradeAgreement>
               <ram:SpecifiedLineTradeDelivery>
                    <ram:BilledQuantity unitCode="C62">1.0000</ram:BilledQuantity>
               </ram:SpecifiedLineTradeDelivery>
               <ram:SpecifiedLineTradeSettlement>
                    <ram:ApplicableTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:ApplicableTradeTax>
                    <ram:SpecifiedTradeSettlementLineMonetarySummation>
                         <ram:LineTotalAmount>7.00</ram:LineTotalAmount>
                    </ram:SpecifiedTradeSettlementLineMonetarySummation>
                    <ram:ReceivableSpecifiedTradeAccountingAccount>
                         <ram:ID>BUY_ACC_REF</ram:ID>
                    </ram:ReceivableSpecifiedTradeAccountingAccount>
               </ram:SpecifiedLineTradeSettlement>
          </ram:IncludedSupplyChainTradeLineItem>
          <ram:ApplicableHeaderTradeAgreement>
               <ram:BuyerReference>SERVEXEC</ram:BuyerReference>
               <ram:SellerTradeParty>
                    <ram:ID>123</ram:ID>
                    <ram:GlobalID schemeID="0088">587451236587</ram:GlobalID>
                    <ram:GlobalID schemeID="0009">12345678200077</ram:GlobalID>
                    <ram:GlobalID schemeID="0060">DUNS1235487</ram:GlobalID>
                    <ram:GlobalID schemeID="0177">ODETTE254879</ram:GlobalID>
                    <ram:Name>LE FOURNISSEUR</ram:Name>
                    <ram:Description>SARL AU CAPITAL DE 50 000 EUROS</ram:Description>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">123456782</ram:ID>
                         <ram:TradingBusinessName>SELLER TRADE NAME</ram:TradingBusinessName>
                    </ram:SpecifiedLegalOrganization>
                    <ram:DefinedTradeContact>
                         <ram:PersonName>M. CONTACT</ram:PersonName>
                         <ram:DepartmentName>DEP SELLER</ram:DepartmentName>
                         <ram:TelephoneUniversalCommunication>
                              <ram:CompleteNumber>01 02 03 54 87</ram:CompleteNumber>
                         </ram:TelephoneUniversalCommunication>
                         <ram:EmailURIUniversalCommunication>
                              <ram:URIID>seller@seller.com</ram:URIID>
                         </ram:EmailURIUniversalCommunication>
                    </ram:DefinedTradeContact>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>75018</ram:PostcodeCode>
                         <ram:LineOne>35 rue d'ici</ram:LineOne>
                         <ram:LineTwo>Seller line 2</ram:LineTwo>
                         <ram:LineThree>Seller line 3</ram:LineThree>
                         <ram:CityName>PARIS</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:URIUniversalCommunication>
                         <ram:URIID schemeID="EM">moi@seller.com</ram:URIID>
                    </ram:URIUniversalCommunication>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR11123456782</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:SellerTradeParty>
               <ram:BuyerTradeParty>
                    <ram:GlobalID schemeID="0088">3654789851</ram:GlobalID>
                    <ram:GlobalID schemeID="0009">98765432100029</ram:GlobalID>
                    <ram:GlobalID schemeID="0224">CDROUT1</ram:GlobalID>
                    <ram:GlobalID schemeID="0060">DUNS1235684</ram:GlobalID>
                    <ram:Name>LE CLIENT</ram:Name>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">987654321</ram:ID>
                    </ram:SpecifiedLegalOrganization>
                    <ram:DefinedTradeContact>
                         <ram:PersonName>Buyer contact name</ram:PersonName>
                         <ram:DepartmentName>Buyer dep</ram:DepartmentName>
                         <ram:TelephoneUniversalCommunication>
                              <ram:CompleteNumber>01 01 25 45 87</ram:CompleteNumber>
                         </ram:TelephoneUniversalCommunication>
                         <ram:EmailURIUniversalCommunication>
                              <ram:URIID>buyer@buyer.com</ram:URIID>
                         </ram:EmailURIUniversalCommunication>
                    </ram:DefinedTradeContact>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>06000</ram:PostcodeCode>
                         <ram:LineOne>MON ADRESSE LIGNE 1</ram:LineOne>
                         <ram:LineTwo>Buyer line 2</ram:LineTwo>
                         <ram:LineThree>Buyer line 3</ram:LineThree>
                         <ram:CityName>MA VILLE</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:URIUniversalCommunication>
                         <ram:URIID schemeID="EM">me@buyer.com</ram:URIID>
                    </ram:URIUniversalCommunication>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR 05 987 654 321</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:BuyerTradeParty>
               <ram:SellerTaxRepresentativeTradeParty>
                    <ram:Name>SELLER TAX REP</ram:Name>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>75018</ram:PostcodeCode>
                         <ram:LineOne>35 rue d'ici</ram:LineOne>
                         <ram:LineTwo>Seller line 2</ram:LineTwo>
                         <ram:LineThree>Seller line 3</ram:LineThree>
                         <ram:CityName>PARIS</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
                    <ram:SpecifiedTaxRegistration>
                         <ram:ID schemeID="VA">FR 05 987 654 321</ram:ID>
                    </ram:SpecifiedTaxRegistration>
               </ram:SellerTaxRepresentativeTradeParty>
               <ram:SellerOrderReferencedDocument>
                    <ram:IssuerAssignedID>SALES REF 2547</ram:IssuerAssignedID>
               </ram:SellerOrderReferencedDocument>
               <ram:BuyerOrderReferencedDocument>
                    <ram:IssuerAssignedID>PO201925478</ram:IssuerAssignedID>
               </ram:BuyerOrderReferencedDocument>
               <ram:ContractReferencedDocument>
                    <ram:IssuerAssignedID>CT2018120802</ram:IssuerAssignedID>
               </ram:ContractReferencedDocument>
               <ram:AdditionalReferencedDocument>
                    <ram:IssuerAssignedID>SUPPort doc</ram:IssuerAssignedID>
                    <ram:URIID>url:gffter</ram:URIID>
                    <ram:TypeCode>916</ram:TypeCode>
                    <ram:Name>support descript</ram:Name>
               </ram:AdditionalReferencedDocument>
               <ram:AdditionalReferencedDocument>
                    <ram:IssuerAssignedID>TENDER-002</ram:IssuerAssignedID>
                    <ram:TypeCode>50</ram:TypeCode>
               </ram:AdditionalReferencedDocument>
               <ram:AdditionalReferencedDocument>
                    <ram:IssuerAssignedID>REFCLI0215</ram:IssuerAssignedID>
                    <ram:TypeCode>130</ram:TypeCode>
                    <ram:ReferenceTypeCode>IT</ram:ReferenceTypeCode>
               </ram:AdditionalReferencedDocument>
               <ram:SpecifiedProcuringProject>
                    <ram:ID>PROJET2547</ram:ID>
                    <ram:Name>Project reference</ram:Name>
               </ram:SpecifiedProcuringProject>
          </ram:ApplicableHeaderTradeAgreement>
          <ram:ApplicableHeaderTradeDelivery>
               <ram:ShipToTradeParty>
                    <ram:ID>PRIVATE_ID_DEL</ram:ID>
                    <ram:Name>DEL Name</ram:Name>
                    <ram:PostalTradeAddress>
                         <ram:PostcodeCode>06000</ram:PostcodeCode>
                         <ram:LineOne>DEL ADRESSE LIGNE 1</ram:LineOne>
                         <ram:LineTwo>DEL line 2</ram:LineTwo>
                         <ram:CityName>NICE</ram:CityName>
                         <ram:CountryID>FR</ram:CountryID>
                    </ram:PostalTradeAddress>
               </ram:ShipToTradeParty>
               <ram:ActualDeliverySupplyChainEvent>
                    <ram:OccurrenceDateTime>
                         <udt:DateTimeString format="102">20220128</udt:DateTimeString>
                    </ram:OccurrenceDateTime>
               </ram:ActualDeliverySupplyChainEvent>
               <ram:DespatchAdviceReferencedDocument>
                    <ram:IssuerAssignedID>DESPADV002</ram:IssuerAssignedID>
               </ram:DespatchAdviceReferencedDocument>
               <ram:ReceivingAdviceReferencedDocument>
                    <ram:IssuerAssignedID>RECEIV-ADV002</ram:IssuerAssignedID>
               </ram:ReceivingAdviceReferencedDocument>
          </ram:ApplicableHeaderTradeDelivery>
          <ram:ApplicableHeaderTradeSettlement>
               <ram:CreditorReferenceID>CREDID</ram:CreditorReferenceID>
               <ram:PaymentReference>F20180023BUYER</ram:PaymentReference>
               <ram:InvoiceCurrencyCode>EUR</ram:InvoiceCurrencyCode>
               <ram:PayeeTradeParty>
                    <ram:GlobalID schemeID="0088">587451236586</ram:GlobalID>
                    <ram:Name>PAYEE NAME</ram:Name>
                    <ram:SpecifiedLegalOrganization>
                         <ram:ID schemeID="0002">303656847</ram:ID>
                    </ram:SpecifiedLegalOrganization>
               </ram:PayeeTradeParty>
               <ram:SpecifiedTradeSettlementPaymentMeans>
                    <ram:TypeCode>30</ram:TypeCode>
                    <ram:Information>Virement</ram:Information>
                    <ram:PayerPartyDebtorFinancialAccount>
                         <ram:IBANID>FRDEBIT</ram:IBANID>
                    </ram:PayerPartyDebtorFinancialAccount>
                    <ram:PayeePartyCreditorFinancialAccount>
                         <ram:IBANID>FR20 1254 2547 2569 8542 5874 698</ram:IBANID>
                         <ram:AccountName>MON COMPTE BANCAIRE</ram:AccountName>
                         <ram:ProprietaryID>LOC BANK ACCOUNT</ram:ProprietaryID>
                    </ram:PayeePartyCreditorFinancialAccount>
                    <ram:PayeeSpecifiedCreditorFinancialInstitution>
                         <ram:BICID>BIC_MONCOMPTE</ram:BICID>
                    </ram:PayeeSpecifiedCreditorFinancialInstitution>
               </ram:SpecifiedTradeSettlementPaymentMeans>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>2.20</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:BasisAmount>11.00</ram:BasisAmount>
                    <ram:CategoryCode>S</ram:CategoryCode>
                    <ram:DueDateTypeCode>72</ram:DueDateTypeCode>
                    <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>0.00</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:ExemptionReason>DEBOURS</ram:ExemptionReason>
                    <ram:BasisAmount>60.00</ram:BasisAmount>
                    <ram:CategoryCode>E</ram:CategoryCode>
                    <ram:ExemptionReasonCode>VATEX-EU-79-C</ram:ExemptionReasonCode>
                    <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>2.70</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:BasisAmount>27.00</ram:BasisAmount>
                    <ram:CategoryCode>S</ram:CategoryCode>
                    <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:ApplicableTradeTax>
                    <ram:CalculatedAmount>0.00</ram:CalculatedAmount>
                    <ram:TypeCode>VAT</ram:TypeCode>
                    <ram:ExemptionReason>LIVRAISON INTRACOMMUNAUTAIRE</ram:ExemptionReason>
                    <ram:BasisAmount>2.00</ram:BasisAmount>
                    <ram:CategoryCode>K</ram:CategoryCode>
                    <ram:ExemptionReasonCode>VATEX-EU-IC</ram:ExemptionReasonCode>
                    <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
               </ram:ApplicableTradeTax>
               <ram:BillingSpecifiedPeriod>
                    <ram:StartDateTime>
                         <udt:DateTimeString format="102">20220101</udt:DateTimeString>
                    </ram:StartDateTime>
                    <ram:EndDateTime>
                         <udt:DateTimeString format="102">20221231</udt:DateTimeString>
                    </ram:EndDateTime>
               </ram:BillingSpecifiedPeriod>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>5.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>5.00</ram:ActualAmount>
                    <ram:ReasonCode>95</ram:ReasonCode>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>100</ram:ReasonCode>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>100</ram:ReasonCode>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>false</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>2.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>2.00</ram:ActualAmount>
                    <ram:Reason>REMISE COMMERCIALE</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>10.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>10.00</ram:ActualAmount>
                    <ram:ReasonCode>FC</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>ADR</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>20.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>2.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>2.00</ram:ActualAmount>
                    <ram:ReasonCode>FC</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>K</ram:CategoryCode>
                         <ram:RateApplicablePercent>0.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradeAllowanceCharge>
                    <ram:ChargeIndicator>
                         <udt:Indicator>true</udt:Indicator>
                    </ram:ChargeIndicator>
                    <ram:CalculationPercent>1.00</ram:CalculationPercent>
                    <ram:BasisAmount>100.00</ram:BasisAmount>
                    <ram:ActualAmount>1.00</ram:ActualAmount>
                    <ram:ReasonCode>FC</ram:ReasonCode>
                    <ram:Reason>FRAIS DEPLACEMENT</ram:Reason>
                    <ram:CategoryTradeTax>
                         <ram:TypeCode>VAT</ram:TypeCode>
                         <ram:CategoryCode>S</ram:CategoryCode>
                         <ram:RateApplicablePercent>10.00</ram:RateApplicablePercent>
                    </ram:CategoryTradeTax>
               </ram:SpecifiedTradeAllowanceCharge>
               <ram:SpecifiedTradePaymentTerms>
                    <ram:Description>PAIEMENT 30 JOURS NET</ram:Description>
                    <ram:DueDateDateTime>
                         <udt:DateTimeString format="102">20220302</udt:DateTimeString>
                    </ram:DueDateDateTime>
                    <ram:DirectDebitMandateID>MANDATE PT</ram:DirectDebitMandateID>
               </ram:SpecifiedTradePaymentTerms>
               <ram:SpecifiedTradeSettlementHeaderMonetarySummation>
                    <ram:LineTotalAmount>95.00</ram:LineTotalAmount>
                    <ram:ChargeTotalAmount>14.00</ram:ChargeTotalAmount>
                    <ram:AllowanceTotalAmount>9.00</ram:AllowanceTotalAmount>
                    <ram:TaxBasisTotalAmount>100.00</ram:TaxBasisTotalAmount>
                    <ram:TaxTotalAmount currencyID="EUR">4.90</ram:TaxTotalAmount>
                     <ram:RoundingAmount>0.00</ram:RoundingAmount>
                    <ram:GrandTotalAmount>104.90</ram:GrandTotalAmount>
                    <ram:TotalPrepaidAmount>0.00</ram:TotalPrepaidAmount>
                    <ram:DuePayableAmount>104.90</ram:DuePayableAmount>
               </ram:SpecifiedTradeSettlementHeaderMonetarySummation>
               <ram:InvoiceReferencedDocument>
                    <ram:IssuerAssignedID>F20220003</ram:IssuerAssignedID>
                    <ram:FormattedIssueDateTime>
                         <qdt:DateTimeString format="102">20220101</qdt:DateTimeString>
                    </ram:FormattedIssueDateTime>
               </ram:InvoiceReferencedDocument>
               <ram:ReceivableSpecifiedTradeAccountingAccount>
                    <ram:ID>BUYER ACCOUNT REF</ram:ID>
               </ram:ReceivableSpecifiedTradeAccountingAccount>
          </ram:ApplicableHeaderTradeSettlement>
     </rsm:SupplyChainTradeTransaction>
</rsm:CrossIndustryInvoice>
XML;

        $writer = (new Writer())->generate(
            pdfContent: $pdfContent,
            xmlContent: $xml,
            addLogo: true
        );

        file_put_contents(__DIR__ . \DIRECTORY_SEPARATOR . 'extended_facturx.pdf', $writer);

        $extractedXml = (new Reader())->extractXML($writer);
        $this->assertSame($xml, $extractedXml);
    }
}
