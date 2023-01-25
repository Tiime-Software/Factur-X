<?php

namespace Tiime\FacturX\DataType;

enum PaymentMeansCode: string
{
    case INSTRUMENT_NOT_DEFINED = "1";
    case AUTOMATED_CLEARING_HOUSE_CREDIT = "2";
    case AUTOMATED_CLEARING_HOUSE_DEBIT = "3";
    case ACH_DEMAND_DEBIT_REVERSAL = "4";
    case ACH_DEMAND_CREDIT_REVERSAL = "5";
    case ACH_DEMAND_CREDIT = "6";
    case ACH_DEMAND_DEBIT = "7";
    case HOLD = "8";
    case NATIONAL_OR_REGIONAL_CLEARING = "9";
    case IN_CASH = "10";
    case ACH_SAVINGS_CREDIT_REVERSAL = "11";
    case ACH_SAVINGS_DEBIT_REVERSAL = "12";
    case ACH_SAVINGS_CREDIT = "13";
    case ACH_SAVINGS_DEBIT = "14";
    case BOOKENTRY_CREDIT = "15";
    case BOOKENTRY_DEBIT = "16";
    case ACH_DEMAND_CASH_CONCENTRATION_DISBURSEMENT_CREDIT = "17";
    case ACH_DEMAND_CASH_CONCENTRATION_DISBURSEMENT_DEBIT = "18";
    case ACH_DEMAND_CORPORATE_TRADE_PAYMENT_CREDIT = "19";
    case CHEQUE = "20";
    case BANKER_DRAFT = "21";
    case CERTIFIED_BANKER_DRAFT = "22";
    case BANK_CHEQUE = "23";
    case BILL_OF_EXCHANGE_AWAITING_ACCEPTANCE = "24";
    case CERTIFIED_CHEQUE = "25";
    case LOCAL_CHEQUE = "26";
    case ACH_DEMAND_CORPORATE_TRADE_PAYMENT_DEBIT = "27";
    case ACH_DEMAND_CORPORATE_TRADE_EXCHANGE_CREDIT = "28";
    case ACH_DEMAND_CORPORATE_TRADE_EXCHANGE_DEBIT = "29";
    case CREDIT_TRANSFER = "30";
    case DEBIT_TRANSFER = "31";
    case ACH_DEMAND_CASH_CONCENTRATION_DISBURSEMENT_PLUS_CREDIT = "32";
    case ACH_DEMAND_CASH_CONCENTRATION_DISBURSEMENT_PLUS_DEBIT = "33";
    case ACH_PREARRANGED_PAYMENT_AND_DEPOSIT = "34";
    case ACH_SAVINGS_CASH_CONCENTRATION_DISBURSEMENT_CREDIT = "35";
    case ACH_SAVINGS_CASH_CONCENTRATION_DISBURSEMENT_DEBIT = "36";
    case ACH_SAVINGS_CORPORATE_TRADE_PAYMENT_CREDIT = "37";
    case ACH_SAVINGS_CORPORATE_TRADE_PAYMENT_DEBIT = "38";
    case ACH_SAVINGS_CORPORATE_TRADE_EXCHANGE_CREDIT = "39";
    case ACH_SAVINGS_CORPORATE_TRADE_EXCHANGE_DEBIT = "40";
    case ACH_SAVINGS_CASH_CONCENTRATION_DISBURSEMENT_PLUS_CREDIT = "41";
    case PAYMENT_TO_BANK_ACCOUNT = "42";
    case ACH_SAVINGS_CASH_CONCENTRATION_DISBURSEMENT_PLUS_DEBIT = "43";
    case ACCEPTED_BILL_OF_EXCHANGE = "44";
    case REFERENCED_HOME_BANKING_CREDIT_TRANSFER = "45";
    case INTERBANK_DEBIT_TRANSFER = "46";
    case HOME_BANKING_DEBIT_TRANSFER = "47";
    case BANK_CARD = "48";
    case DIRECT_DEBIT = "49";
    case PAYMENT_BY_POSTGIRO = "50";
    case TELEREGLEMENT_CFONB = "51";
    case URGENT_COMMERCIAL_PAYMENT = "52";
    case URGENT_TREASURY_PAYMENT = "53";
    case CREDIT_CARD = "54";
    case DEBIT_CARD = "55";
    case BANKGIRO = "56";
    case STANDING_AGREEMENT = "57";
    case SEPA_CREDIT_TRANSFER = "58";
    case SEPA_DIRECT_DEBIT = "59";
    case PROMISSORY_NOTE = "60";
    case PROMISSORY_NOTE_SIGNED_BY_THE_DEBTOR = "61";
    case PROMISSORY_NOTE_SIGNED_BY_THE_DEBTOR_AND_ENDORSED_BY_A_BANK = "62";
    case PROMISSORY_NOTE_SIGNED_BY_THE_DEBTOR_AND_ENDORSED_BY_A_THIRD_PARTY = "63";
    case PROMISSORY_NOTE_SIGNED_BY_A_BANK = "64";
    case PROMISSORY_NOTE_SIGNED_BY_A_BANK_AND_ENDORSED_BY_ANOTHER_BANK = "65";
    case PROMISSORY_NOTE_SIGNED_BY_A_THIRD_PARTY = "66";
    case PROMISSORY_NOTE_SIGNED_BY_A_THIRD_PARTY_AND_ENDORSED_BY_A_BANK = "67";
    case ONLINE_PAYMENT_SERVICE = "68";
    case TRANSFER_ADVICE = "69";
    case BILL_DRAWN_BY_THE_CREDITOR_ON_THE_DEBTOR = "70";
    case BILL_DRAWN_BY_THE_CREDITOR_ON_A_BANK = "74";
    case BILL_DRAWN_BY_THE_CREDITOR_ENDORSED_BY_ANOTHER_BANK = "75";
    case BILL_DRAWN_BY_THE_CREDITOR_ON_A_BANK_AND_ENDORSED_BY_A_THIRD_PARTY = "76";
    case BILL_DRAWN_BY_THE_CREDITOR_ON_A_THIRD_PARTY = "77";
    case BILL_DRAWN_BY_CREDITOR_ON_THIRD_PARTY_ACCEPTED_AND_ENDORSED_BY_BANK = "78";
    case NOT_TRANSFERABLE_BANKER_DRAFT = "91";
    case NOT_TRANSFERABLE_LOCAL_CHEQUE = "92";
    case REFERENCE_GIRO = "93";
    case URGENT_GIRO = "94";
    case FREE_FORMAT_GIRO = "95";
    case REQUESTED_METHOD_FOR_PAYMENT_WAS_NOT_USED = "96";
    case CLEARING_BETWEEN_PARTNERS = "97";
    case MUTUALLY_DEFINED = "ZZZ";
}