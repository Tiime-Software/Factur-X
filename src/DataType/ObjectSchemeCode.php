<?php

namespace Tiime\FacturX\DataType;

enum ObjectSchemeCode: string
{
    case ORDER_ACKNOWLEDGEMENT_DOCUMENT_IDENTIFIER = "AAA";
    case PROFORMA_INVOICE_DOCUMENT_IDENTIFIER = "AAB";
    case DOCUMENTARY_CREDIT_IDENTIFIER = "AAC";
    case CONTRACT_DOCUMENT_ADDENDUM_IDENTIFIER = "AAD";
    case GOODS_DECLARATION_NUMBER = "AAE";
    case DEBIT_CARD_NUMBER = "AAF";
    case OFFER_NUMBER = "AAG";
    case BANK_BATCH_INTERBANK_TRANSACTION_REFERENCE_NUMBER = "AAH";
    case BANK_INDIVIDUAL_INTERBANK_TRANSACTION_REFERENCE_NUMBER = "AAI";
    case DELIVERY_ORDER_NUMBER = "AAJ";
    case DESPATCH_ADVICE_NUMBER = "AAK";
    case DRAWING_NUMBER = "AAL";
    case WAYBILL_NUMBER = "AAM";
    case DELIVERY_SCHEDULE_NUMBER = "AAN";
    case CONSIGNMENT_IDENTIFIER__CONSIGNEE_ASSIGNED = "AAO";
    case PARTIAL_SHIPMENT_IDENTIFIER = "AAP";
    case TRANSPORT_EQUIPMENT_IDENTIFIER = "AAQ";
    case MUNICIPALITY_ASSIGNED_BUSINESS_REGISTRY_NUMBER = "AAR";
    case TRANSPORT_CONTRACT_DOCUMENT_IDENTIFIER = "AAS";
    case MASTER_LABEL_NUMBER = "AAT";
    case DESPATCH_NOTE_DOCUMENT_IDENTIFIER = "AAU";
    case ENQUIRY_NUMBER = "AAV";
    case DOCKET_NUMBER = "AAW";
    case CIVIL_ACTION_NUMBER = "AAX";
    case CARRIER_AGENT_REFERENCE_NUMBER = "AAY";
    case STANDARD_CARRIER_ALPHA_CODE__SCAC__NUMBER = "AAZ";
    case CUSTOMS_VALUATION_DECISION_NUMBER = "ABA";
    case END_USE_AUTHORIZATION_NUMBER = "ABB";
    case ANTI_DUMPING_CASE_NUMBER = "ABC";
    case CUSTOMS_TARIFF_NUMBER = "ABD";
    case DECLARANT_REFERENCE_NUMBER = "ABE";
    case REPAIR_ESTIMATE_NUMBER = "ABF";
    case CUSTOMS_DECISION_REQUEST_NUMBER = "ABG";
    case SUB_HOUSE_BILL_OF_LADING_NUMBER = "ABH";
    case TAX_PAYMENT_IDENTIFIER = "ABI";
    case QUOTA_NUMBER = "ABJ";
    case TRANSIT__ONWARD_CARRIAGE__GUARANTEE__BOND__NUMBER = "ABK";
    case CUSTOMS_GUARANTEE_NUMBER = "ABL";
    case REPLACING_PART_NUMBER = "ABM";
    case SELLER_CATALOGUE_NUMBER = "ABN";
    case ORIGINATOR_REFERENCE = "ABO";
    case DECLARANT_CUSTOMS_IDENTITY_NUMBER = "ABP";
    case IMPORTER_REFERENCE_NUMBER = "ABQ";
    case EXPORT_CLEARANCE_INSTRUCTION_REFERENCE_NUMBER = "ABR";
    case IMPORT_CLEARANCE_INSTRUCTION_REFERENCE_NUMBER = "ABS";
    case GOODS_DECLARATION_DOCUMENT_IDENTIFIER__CUSTOMS = "ABT";
    case ARTICLE_NUMBER = "ABU";
    case INTRA_PLANT_ROUTING = "ABV";
    case STOCK_KEEPING_UNIT_NUMBER = "ABW";
    case TEXT_ELEMENT_IDENTIFIER_DELETION_REFERENCE = "ABX";
    case ALLOTMENT_IDENTIFICATION__AIR_ = "ABY";
    case VEHICLE_LICENCE_NUMBER = "ABZ";
    case AIR_CARGO_TRANSFER_MANIFEST = "AC";
    case CARGO_ACCEPTANCE_ORDER_REFERENCE_NUMBER = "ACA";
    case US_GOVERNMENT_AGENCY_NUMBER = "ACB";
    case SHIPPING_UNIT_IDENTIFICATION = "ACC";
    case ADDITIONAL_REFERENCE_NUMBER = "ACD";
    case RELATED_DOCUMENT_NUMBER = "ACE";
    case ADDRESSEE_REFERENCE = "ACF";
    case ATA_CARNET_NUMBER = "ACG";
    case PACKAGING_UNIT_IDENTIFICATION = "ACH";
    case OUTERPACKAGING_UNIT_IDENTIFICATION = "ACI";
    case CUSTOMER_MATERIAL_SPECIFICATION_NUMBER = "ACJ";
    case BANK_REFERENCE = "ACK";
    case PRINCIPAL_REFERENCE_NUMBER = "ACL";
    case COLLECTION_ADVICE_DOCUMENT_IDENTIFIER = "ACN";
    case IRON_CHARGE_NUMBER = "ACO";
    case HOT_ROLL_NUMBER = "ACP";
    case COLD_ROLL_NUMBER = "ACQ";
    case RAILWAY_WAGON_NUMBER = "ACR";
    case UNIQUE_CLAIMS_REFERENCE_NUMBER_OF_THE_SENDER = "ACT";
    case LOSS_EVENT_NUMBER = "ACU";
    case ESTIMATE_ORDER_REFERENCE_NUMBER = "ACV";
    case REFERENCE_NUMBER_TO_PREVIOUS_MESSAGE = "ACW";
    case BANKER_ACCEPTANCE = "ACX";
    case DUTY_MEMO_NUMBER = "ACY";
    case EQUIPMENT_TRANSPORT_CHARGE_NUMBER = "ACZ";
    case BUYER_ITEM_NUMBER = "ADA";
    case MATURED_CERTIFICATE_OF_DEPOSIT = "ADB";
    case LOAN = "ADC";
    case ANALYSIS_NUMBER_TEST_NUMBER = "ADD";
    case ACCOUNT_NUMBER = "ADE";
    case TREATY_NUMBER = "ADF";
    case CATASTROPHE_NUMBER = "ADG";
    case BUREAU_SIGNING__STATEMENT_REFERENCE_ = "ADI";
    case COMPANY___SYNDICATE_REFERENCE_1 = "ADJ";
    case COMPANY___SYNDICATE_REFERENCE_2 = "ADK";
    case ORDERING_CUSTOMER_CONSIGNMENT_REFERENCE_NUMBER = "ADL";
    case SHIPOWNER_AUTHORIZATION_NUMBER = "ADM";
    case INLAND_TRANSPORT_ORDER_NUMBER = "ADN";
    case CONTAINER_WORK_ORDER_REFERENCE_NUMBER = "ADO";
    case STATEMENT_NUMBER = "ADP";
    case UNIQUE_MARKET_REFERENCE = "ADQ";
    case GROUP_ACCOUNTING = "ADT";
    case BROKER_REFERENCE_1 = "ADU";
    case BROKER_REFERENCE_2 = "ADV";
    case LLOYD_CLAIMS_OFFICE_REFERENCE = "ADW";
    case SECURE_DELIVERY_TERMS_AND_CONDITIONS_AGREEMENT_REFERENCE = "ADX";
    case REPORT_NUMBER = "ADY";
    case TRADER_ACCOUNT_NUMBER = "ADZ";
    case AUTHORIZATION_FOR_EXPENSE__AFE__NUMBER = "AE";
    case GOVERNMENT_AGENCY_REFERENCE_NUMBER = "AEA";
    case ASSEMBLY_NUMBER = "AEB";
    case SYMBOL_NUMBER = "AEC";
    case COMMODITY_NUMBER = "AED";
    case EUR_1_CERTIFICATE_NUMBER = "AEE";
    case CUSTOMER_PROCESS_SPECIFICATION_NUMBER = "AEF";
    case CUSTOMER_SPECIFICATION_NUMBER = "AEG";
    case APPLICABLE_INSTRUCTIONS_OR_STANDARDS = "AEH";
    case REGISTRATION_NUMBER_OF_PREVIOUS_CUSTOMS_DECLARATION = "AEI";
    case POST_ENTRY_REFERENCE = "AEJ";
    case PAYMENT_ORDER_NUMBER = "AEK";
    case DELIVERY_NUMBER__TRANSPORT_ = "AEL";
    case TRANSPORT_ROUTE = "AEM";
    case CUSTOMER_UNIT_INVENTORY_NUMBER = "AEN";
    case PRODUCT_RESERVATION_NUMBER = "AEO";
    case PROJECT_NUMBER = "AEP";
    case DRAWING_LIST_NUMBER = "AEQ";
    case PROJECT_SPECIFICATION_NUMBER = "AER";
    case PRIMARY_REFERENCE = "AES";
    case REQUEST_FOR_CANCELLATION_NUMBER = "AET";
    case SUPPLIER_CONTROL_NUMBER = "AEU";
    case SHIPPING_NOTE_NUMBER = "AEV";
    case EMPTY_CONTAINER_BILL_NUMBER = "AEW";
    case NON_NEGOTIABLE_MARITIME_TRANSPORT_DOCUMENT_NUMBER = "AEX";
    case SUBSTITUTE_AIR_WAYBILL_NUMBER = "AEY";
    case DESPATCH_NOTE__POST_PARCELS__NUMBER = "AEZ";
    case AIRLINES_FLIGHT_IDENTIFICATION_NUMBER = "AF";
    case THROUGH_BILL_OF_LADING_NUMBER = "AFA";
    case CARGO_MANIFEST_NUMBER = "AFB";
    case BORDEREAU_NUMBER = "AFC";
    case CUSTOMS_ITEM_NUMBER = "AFD";
    case EXPORT_CONTROL_COMMODITY_NUMBER__ECCN_ = "AFE";
    case MARKING_LABEL_REFERENCE = "AFF";
    case TARIFF_NUMBER = "AFG";
    case REPLENISHMENT_PURCHASE_ORDER_NUMBER = "AFH";
    case IMMEDIATE_TRANSPORTATION_NO__FOR_IN_BOND_MOVEMENT = "AFI";
    case TRANSPORTATION_EXPORTATION_NO__FOR_IN_BOND_MOVEMENT = "AFJ";
    case IMMEDIATE_EXPORTATION_NO__FOR_IN_BOND_MOVEMENT = "AFK";
    case ASSOCIATED_INVOICES = "AFL";
    case SECONDARY_CUSTOMS_REFERENCE = "AFM";
    case ACCOUNT_PARTY_REFERENCE = "AFN";
    case BENEFICIARY_REFERENCE = "AFO";
    case SECOND_BENEFICIARY_REFERENCE = "AFP";
    case APPLICANT_BANK_REFERENCE = "AFQ";
    case ISSUING_BANK_REFERENCE = "AFR";
    case BENEFICIARY_BANK_REFERENCE = "AFS";
    case DIRECT_PAYMENT_VALUATION_NUMBER = "AFT";
    case DIRECT_PAYMENT_VALUATION_REQUEST_NUMBER = "AFU";
    case QUANTITY_VALUATION_NUMBER = "AFV";
    case QUANTITY_VALUATION_REQUEST_NUMBER = "AFW";
    case BILL_OF_QUANTITIES_NUMBER = "AFX";
    case PAYMENT_VALUATION_NUMBER = "AFY";
    case SITUATION_NUMBER = "AFZ";
    case AGREEMENT_TO_PAY_NUMBER = "AGA";
    case CONTRACT_PARTY_REFERENCE_NUMBER = "AGB";
    case ACCOUNT_PARTY_BANK_REFERENCE = "AGC";
    case AGENT_BANK_REFERENCE = "AGD";
    case AGENT_REFERENCE = "AGE";
    case APPLICANT_REFERENCE = "AGF";
    case DISPUTE_NUMBER = "AGG";
    case CREDIT_RATING_AGENCY_REFERENCE_NUMBER = "AGH";
    case REQUEST_NUMBER = "AGI";
    case SINGLE_TRANSACTION_SEQUENCE_NUMBER = "AGJ";
    case APPLICATION_REFERENCE_NUMBER = "AGK";
    case DELIVERY_VERIFICATION_CERTIFICATE = "AGL";
    case NUMBER_OF_TEMPORARY_IMPORTATION_DOCUMENT = "AGM";
    case REFERENCE_NUMBER_QUOTED_ON_STATEMENT = "AGN";
    case SENDER_REFERENCE_TO_THE_ORIGINAL_MESSAGE = "AGO";
    case COMPANY_ISSUED_EQUIPMENT_ID = "AGP";
    case DOMESTIC_FLIGHT_NUMBER = "AGQ";
    case INTERNATIONAL_FLIGHT_NUMBER = "AGR";
    case EMPLOYER_IDENTIFICATION_NUMBER_OF_SERVICE_BUREAU = "AGS";
    case SERVICE_GROUP_IDENTIFICATION_NUMBER = "AGT";
    case MEMBER_NUMBER = "AGU";
    case PREVIOUS_MEMBER_NUMBER = "AGV";
    case SCHEME_PLAN_NUMBER = "AGW";
    case PREVIOUS_SCHEME_PLAN_NUMBER = "AGX";
    case RECEIVING_PARTY_MEMBER_IDENTIFICATION = "AGY";
    case PAYROLL_NUMBER = "AGZ";
    case PACKAGING_SPECIFICATION_NUMBER = "AHA";
    case AUTHORITY_ISSUED_EQUIPMENT_IDENTIFICATION = "AHB";
    case TRAINING_FLIGHT_NUMBER = "AHC";
    case FUND_CODE_NUMBER = "AHD";
    case SIGNAL_CODE_NUMBER = "AHE";
    case MAJOR_FORCE_PROGRAM_NUMBER = "AHF";
    case NOMINATION_NUMBER = "AHG";
    case LABORATORY_REGISTRATION_NUMBER = "AHH";
    case TRANSPORT_CONTRACT_REFERENCE_NUMBER = "AHI";
    case PAYEE_REFERENCE_NUMBER = "AHJ";
    case PAYER_REFERENCE_NUMBER = "AHK";
    case CREDITOR_REFERENCE_NUMBER = "AHL";
    case DEBTOR_REFERENCE_NUMBER = "AHM";
    case JOINT_VENTURE_REFERENCE_NUMBER = "AHN";
    case CHAMBER_OF_COMMERCE_REGISTRATION_NUMBER = "AHO";
    case TAX_REGISTRATION_NUMBER = "AHP";
    case WOOL_IDENTIFICATION_NUMBER = "AHQ";
    case WOOL_TAX_REFERENCE_NUMBER = "AHR";
    case MEAT_PROCESSING_ESTABLISHMENT_REGISTRATION_NUMBER = "AHS";
    case QUARANTINE_TREATMENT_STATUS_REFERENCE_NUMBER = "AHT";
    case REQUEST_FOR_QUOTE_NUMBER = "AHU";
    case MANUAL_PROCESSING_AUTHORITY_NUMBER = "AHV";
    case RATE_NOTE_NUMBER = "AHX";
    case FREIGHT_FORWARDER_NUMBER = "AHY";
    case CUSTOMS_RELEASE_CODE = "AHZ";
    case COMPLIANCE_CODE_NUMBER = "AIA";
    case DEPARTMENT_OF_TRANSPORTATION_BOND_NUMBER = "AIB";
    case EXPORT_ESTABLISHMENT_NUMBER = "AIC";
    case CERTIFICATE_OF_CONFORMITY = "AID";
    case MINISTERIAL_CERTIFICATE_OF_HOMOLOGATION = "AIE";
    case PREVIOUS_DELIVERY_INSTRUCTION_NUMBER = "AIF";
    case PASSPORT_NUMBER = "AIG";
    case COMMON_TRANSACTION_REFERENCE_NUMBER = "AIH";
    case BANK_COMMON_TRANSACTION_REFERENCE_NUMBER = "AII";
    case CUSTOMER_INDIVIDUAL_TRANSACTION_REFERENCE_NUMBER = "AIJ";
    case BANK_INDIVIDUAL_TRANSACTION_REFERENCE_NUMBER = "AIK";
    case CUSTOMER_COMMON_TRANSACTION_REFERENCE_NUMBER = "AIL";
    case INDIVIDUAL_TRANSACTION_REFERENCE_NUMBER = "AIM";
    case PRODUCT_SOURCING_AGREEMENT_NUMBER = "AIN";
    case CUSTOMS_TRANSHIPMENT_NUMBER = "AIO";
    case CUSTOMS_PREFERENCE_INQUIRY_NUMBER = "AIP";
    case PACKING_PLANT_NUMBER = "AIQ";
    case ORIGINAL_CERTIFICATE_NUMBER = "AIR";
    case PROCESSING_PLANT_NUMBER = "AIS";
    case SLAUGHTER_PLANT_NUMBER = "AIT";
    case CHARGE_CARD_ACCOUNT_NUMBER = "AIU";
    case EVENT_REFERENCE_NUMBER = "AIV";
    case TRANSPORT_SECTION_REFERENCE_NUMBER = "AIW";
    case REFERRED_PRODUCT_FOR_MECHANICAL_ANALYSIS = "AIX";
    case REFERRED_PRODUCT_FOR_CHEMICAL_ANALYSIS = "AIY";
    case CONSOLIDATED_INVOICE_NUMBER = "AIZ";
    case PART_REFERENCE_INDICATOR_IN_A_DRAWING = "AJA";
    case U_S__CODE_OF_FEDERAL_REGULATIONS__CFR_ = "AJB";
    case PURCHASING_ACTIVITY_CLAUSE_NUMBER = "AJC";
    case U_S__DEFENSE_FEDERAL_ACQUISITION_REGULATION_SUPPLEMENT = "AJD";
    case AGENCY_CLAUSE_NUMBER = "AJE";
    case CIRCULAR_PUBLICATION_NUMBER = "AJF";
    case U_S__FEDERAL_ACQUISITION_REGULATION = "AJG";
    case U_S__GENERAL_SERVICES_ADMINISTRATION_REGULATION = "AJH";
    case U_S__FEDERAL_INFORMATION_RESOURCES_MANAGEMENT_REGULATION = "AJI";
    case PARAGRAPH = "AJJ";
    case SPECIAL_INSTRUCTIONS_NUMBER = "AJK";
    case SITE_SPECIFIC_PROCEDURES__TERMS__AND_CONDITIONS_NUMBER = "AJL";
    case MASTER_SOLICITATION_PROCEDURES__TERMS__AND_CONDITIONS = "AJM";
    case U_S__DEPARTMENT_OF_VETERANS_AFFAIRS_ACQUISITION_REGULATION = "AJN";
    case MILITARY_INTERDEPARTMENTAL_PURCHASE_REQUEST__MIPR__NUMBER = "AJO";
    case FOREIGN_MILITARY_SALES_NUMBER = "AJP";
    case DEFENSE_PRIORITIES_ALLOCATION_SYSTEM_PRIORITY_RATING = "AJQ";
    case WAGE_DETERMINATION_NUMBER = "AJR";
    case AGREEMENT_NUMBER = "AJS";
    case STANDARD_INDUSTRY_CLASSIFICATION__SIC__NUMBER = "AJT";
    case END_ITEM_NUMBER = "AJU";
    case FEDERAL_SUPPLY_SCHEDULE_ITEM_NUMBER = "AJV";
    case TECHNICAL_DOCUMENT_NUMBER = "AJW";
    case TECHNICAL_ORDER_NUMBER = "AJX";
    case SUFFIX = "AJY";
    case TRANSPORTATION_ACCOUNT_NUMBER = "AJZ";
    case CONTAINER_DISPOSITION_ORDER_REFERENCE_NUMBER = "AKA";
    case CONTAINER_PREFIX = "AKB";
    case TRANSPORT_EQUIPMENT_RETURN_REFERENCE = "AKC";
    case TRANSPORT_EQUIPMENT_SURVEY_REFERENCE = "AKD";
    case TRANSPORT_EQUIPMENT_SURVEY_REPORT_NUMBER = "AKE";
    case TRANSPORT_EQUIPMENT_STUFFING_ORDER = "AKF";
    case VEHICLE_IDENTIFICATION_NUMBER__VIN_ = "AKG";
    case GOVERNMENT_BILL_OF_LADING = "AKH";
    case ORDERING_CUSTOMER_SECOND_REFERENCE_NUMBER = "AKI";
    case DIRECT_DEBIT_REFERENCE = "AKJ";
    case METER_READING_AT_THE_BEGINNING_OF_THE_DELIVERY = "AKK";
    case METER_READING_AT_THE_END_OF_DELIVERY = "AKL";
    case REPLENISHMENT_PURCHASE_ORDER_RANGE_START_NUMBER = "AKM";
    case THIRD_BANK_REFERENCE = "AKN";
    case ACTION_AUTHORIZATION_NUMBER = "AKO";
    case APPROPRIATION_NUMBER = "AKP";
    case PRODUCT_CHANGE_AUTHORITY_NUMBER = "AKQ";
    case GENERAL_CARGO_CONSIGNMENT_REFERENCE_NUMBER = "AKR";
    case CATALOGUE_SEQUENCE_NUMBER = "AKS";
    case FORWARDING_ORDER_NUMBER = "AKT";
    case TRANSPORT_EQUIPMENT_SURVEY_REFERENCE_NUMBER = "AKU";
    case LEASE_CONTRACT_REFERENCE = "AKV";
    case TRANSPORT_COSTS_REFERENCE_NUMBER = "AKW";
    case TRANSPORT_EQUIPMENT_STRIPPING_ORDER = "AKX";
    case PRIOR_POLICY_NUMBER = "AKY";
    case POLICY_NUMBER = "AKZ";
    case PROCUREMENT_BUDGET_NUMBER = "ALA";
    case DOMESTIC_INVENTORY_MANAGEMENT_CODE = "ALB";
    case CUSTOMER_REFERENCE_NUMBER_ASSIGNED_TO_PREVIOUS_BALANCE_OF = "ALC";
    case PREVIOUS_CREDIT_ADVICE_REFERENCE_NUMBER = "ALD";
    case REPORTING_FORM_NUMBER = "ALE";
    case AUTHORIZATION_NUMBER_FOR_EXCEPTION_TO_DANGEROUS_GOODS = "ALF";
    case DANGEROUS_GOODS_SECURITY_NUMBER = "ALG";
    case DANGEROUS_GOODS_TRANSPORT_LICENCE_NUMBER = "ALH";
    case PREVIOUS_RENTAL_AGREEMENT_NUMBER = "ALI";
    case NEXT_RENTAL_AGREEMENT_REASON_NUMBER = "ALJ";
    case CONSIGNEE_INVOICE_NUMBER = "ALK";
    case MESSAGE_BATCH_NUMBER = "ALL";
    case PREVIOUS_DELIVERY_SCHEDULE_NUMBER = "ALM";
    case PHYSICAL_INVENTORY_RECOUNT_REFERENCE_NUMBER = "ALN";
    case RECEIVING_ADVICE_NUMBER = "ALO";
    case RETURNABLE_CONTAINER_REFERENCE_NUMBER = "ALP";
    case RETURNS_NOTICE_NUMBER = "ALQ";
    case SALES_FORECAST_NUMBER = "ALR";
    case SALES_REPORT_NUMBER = "ALS";
    case PREVIOUS_TAX_CONTROL_NUMBER = "ALT";
    case AGERD__AEROSPACE_GROUND_EQUIPMENT_REQUIREMENT_DATA__NUMBER = "ALU";
    case REGISTERED_CAPITAL_REFERENCE = "ALV";
    case STANDARD_NUMBER_OF_INSPECTION_DOCUMENT = "ALW";
    case MODEL = "ALX";
    case FINANCIAL_MANAGEMENT_REFERENCE = "ALY";
    case NOTIFICATION_FOR_COLLECTION_NUMBER__NOTICOL_ = "ALZ";
    case PREVIOUS_REQUEST_FOR_METERED_READING_REFERENCE_NUMBER = "AMA";
    case NEXT_RENTAL_AGREEMENT_NUMBER = "AMB";
    case REFERENCE_NUMBER_OF_A_REQUEST_FOR_METERED_READING = "AMC";
    case HASTENING_NUMBER = "AMD";
    case REPAIR_DATA_REQUEST_NUMBER = "AME";
    case CONSUMPTION_DATA_REQUEST_NUMBER = "AMF";
    case PROFILE_NUMBER = "AMG";
    case CASE_NUMBER = "AMH";
    case GOVERNMENT_QUALITY_ASSURANCE_AND_CONTROL_LEVEL_NUMBER = "AMI";
    case PAYMENT_PLAN_REFERENCE = "AMJ";
    case REPLACED_METER_UNIT_NUMBER = "AMK";
    case REPLENISHMENT_PURCHASE_ORDER_RANGE_END_NUMBER = "AML";
    case INSURER_ASSIGNED_REFERENCE_NUMBER = "AMM";
    case CANADIAN_EXCISE_ENTRY_NUMBER = "AMN";
    case PREMIUM_RATE_TABLE = "AMO";
    case ADVISE_THROUGH_BANK_REFERENCE = "AMP";
    case US__DEPARTMENT_OF_TRANSPORTATION_BOND_SURETY_CODE = "AMQ";
    case US__FOOD_AND_DRUG_ADMINISTRATION_ESTABLISHMENT_INDICATOR = "AMR";
    case US__FEDERAL_COMMUNICATIONS_COMMISSION__FCC__IMPORT = "AMS";
    case GOODS_AND_SERVICES_TAX_IDENTIFICATION_NUMBER = "AMT";
    case INTEGRATED_LOGISTIC_SUPPORT_CROSS_REFERENCE_NUMBER = "AMU";
    case DEPARTMENT_NUMBER = "AMV";
    case BUYER_CATALOGUE_NUMBER = "AMW";
    case FINANCIAL_SETTLEMENT_PARTY_REFERENCE_NUMBER = "AMX";
    case STANDARD_VERSION_NUMBER = "AMY";
    case PIPELINE_NUMBER = "AMZ";
    case ACCOUNT_SERVICING_BANK_REFERENCE_NUMBER = "ANA";
    case COMPLETED_UNITS_PAYMENT_REQUEST_REFERENCE = "ANB";
    case PAYMENT_IN_ADVANCE_REQUEST_REFERENCE = "ANC";
    case PARENT_FILE = "AND";
    case SUB_FILE = "ANE";
    case CAD_FILE_LAYER_CONVENTION = "ANF";
    case TECHNICAL_REGULATION = "ANG";
    case PLOT_FILE = "ANH";
    case FILE_CONVERSION_JOURNAL = "ANI";
    case AUTHORIZATION_NUMBER = "ANJ";
    case REFERENCE_NUMBER_ASSIGNED_BY_THIRD_PARTY = "ANK";
    case DEPOSIT_REFERENCE_NUMBER = "ANL";
    case NAMED_BANK_REFERENCE = "ANM";
    case DRAWEE_REFERENCE = "ANN";
    case CASE_OF_NEED_PARTY_REFERENCE = "ANO";
    case COLLECTING_BANK_REFERENCE = "ANP";
    case REMITTING_BANK_REFERENCE = "ANQ";
    case PRINCIPAL_BANK_REFERENCE = "ANR";
    case PRESENTING_BANK_REFERENCE = "ANS";
    case CONSIGNEE_REFERENCE = "ANT";
    case FINANCIAL_TRANSACTION_REFERENCE_NUMBER = "ANU";
    case CREDIT_REFERENCE_NUMBER = "ANV";
    case RECEIVING_BANK_AUTHORIZATION_NUMBER = "ANW";
    case CLEARING_REFERENCE = "ANX";
    case SENDING_BANK_REFERENCE_NUMBER = "ANY";
    case DOCUMENTARY_PAYMENT_REFERENCE = "AOA";
    case ACCOUNTING_FILE_REFERENCE = "AOD";
    case SENDER_FILE_REFERENCE_NUMBER = "AOE";
    case RECEIVER_FILE_REFERENCE_NUMBER = "AOF";
    case SOURCE_DOCUMENT_INTERNAL_REFERENCE = "AOG";
    case PRINCIPAL_REFERENCE = "AOH";
    case DEBIT_REFERENCE_NUMBER = "AOI";
    case CALENDAR = "AOJ";
    case WORK_SHIFT = "AOK";
    case WORK_BREAKDOWN_STRUCTURE = "AOL";
    case ORGANISATION_BREAKDOWN_STRUCTURE = "AOM";
    case WORK_TASK_CHARGE_NUMBER = "AON";
    case FUNCTIONAL_WORK_GROUP = "AOO";
    case WORK_TEAM = "AOP";
    case DEPARTMENT = "AOQ";
    case STATEMENT_OF_WORK = "AOR";
    case WORK_PACKAGE = "AOS";
    case PLANNING_PACKAGE = "AOT";
    case COST_ACCOUNT = "AOU";
    case WORK_ORDER = "AOV";
    case TRANSPORTATION_CONTROL_NUMBER__TCN_ = "AOW";
    case CONSTRAINT_NOTATION = "AOX";
    case ETERMS_REFERENCE = "AOY";
    case IMPLEMENTATION_VERSION_NUMBER = "AOZ";
    case ACCOUNTS_RECEIVABLE_NUMBER = "AP";
    case INCORPORATED_LEGAL_REFERENCE = "APA";
    case PAYMENT_INSTALMENT_REFERENCE_NUMBER = "APB";
    case EQUIPMENT_OWNER_REFERENCE_NUMBER = "APC";
    case CEDENT_CLAIM_NUMBER = "APD";
    case REINSURER_CLAIM_NUMBER = "APE";
    case PRICE_SALES_CATALOGUE_RESPONSE_REFERENCE_NUMBER = "APF";
    case GENERAL_PURPOSE_MESSAGE_REFERENCE_NUMBER = "APG";
    case INVOICING_DATA_SHEET_REFERENCE_NUMBER = "APH";
    case INVENTORY_REPORT_REFERENCE_NUMBER = "API";
    case CEILING_FORMULA_REFERENCE_NUMBER = "APJ";
    case PRICE_VARIATION_FORMULA_REFERENCE_NUMBER = "APK";
    case REFERENCE_TO_ACCOUNT_SERVICING_BANK_MESSAGE = "APL";
    case PARTY_SEQUENCE_NUMBER = "APM";
    case PURCHASER_REQUEST_REFERENCE = "APN";
    case CONTRACTOR_REQUEST_REFERENCE = "APO";
    case ACCIDENT_REFERENCE_NUMBER = "APP";
    case COMMERCIAL_ACCOUNT_SUMMARY_REFERENCE_NUMBER = "APQ";
    case CONTRACT_BREAKDOWN_REFERENCE = "APR";
    case CONTRACTOR_REGISTRATION_NUMBER = "APS";
    case APPLICABLE_COEFFICIENT_IDENTIFICATION_NUMBER = "APT";
    case SPECIAL_BUDGET_ACCOUNT_NUMBER = "APU";
    case AUTHORISATION_FOR_REPAIR_REFERENCE = "APV";
    case MANUFACTURER_DEFINED_REPAIR_RATES_REFERENCE = "APW";
    case ORIGINAL_SUBMITTER_LOG_NUMBER = "APX";
    case ORIGINAL_SUBMITTER__PARENT_DATA_MAINTENANCE_REQUEST__DMR_ = "APY";
    case ORIGINAL_SUBMITTER__CHILD_DATA_MAINTENANCE_REQUEST__DMR_ = "APZ";
    case ENTRY_POINT_ASSESSMENT_LOG_NUMBER = "AQA";
    case ENTRY_POINT_ASSESSMENT_LOG_NUMBER__PARENT_DMR = "AQB";
    case ENTRY_POINT_ASSESSMENT_LOG_NUMBER__CHILD_DMR = "AQC";
    case DATA_STRUCTURE_TAG = "AQD";
    case CENTRAL_SECRETARIAT_LOG_NUMBER = "AQE";
    case CENTRAL_SECRETARIAT_LOG_NUMBER__PARENT_DATA_MAINTENANCE = "AQF";
    case CENTRAL_SECRETARIAT_LOG_NUMBER__CHILD_DATA_MAINTENANCE = "AQG";
    case INTERNATIONAL_ASSESSMENT_LOG_NUMBER = "AQH";
    case INTERNATIONAL_ASSESSMENT_LOG_NUMBER__PARENT_DATA = "AQI";
    case INTERNATIONAL_ASSESSMENT_LOG_NUMBER__CHILD_DATA_MAINTENANCE = "AQJ";
    case STATUS_REPORT_NUMBER = "AQK";
    case MESSAGE_DESIGN_GROUP_NUMBER = "AQL";
    case US_CUSTOMS_SERVICE__USCS__ENTRY_CODE = "AQM";
    case BEGINNING_JOB_SEQUENCE_NUMBER = "AQN";
    case SENDER_CLAUSE_NUMBER = "AQO";
    case DUN_AND_BRADSTREET_CANADA_8_DIGIT_STANDARD_INDUSTRIAL = "AQP";
    case ACTIVITE_PRINCIPALE_EXERCEE__APE__IDENTIFIER = "AQQ";
    case DUN_AND_BRADSTREET_US_8_DIGIT_STANDARD_INDUSTRIAL = "AQR";
    case NOMENCLATURE_ACTIVITY_CLASSIFICATION_ECONOMY__NACE_ = "AQS";
    case NORME_ACTIVITE_FRANCAISE__NAF__IDENTIFIER = "AQT";
    case REGISTERED_CONTRACTOR_ACTIVITY_TYPE = "AQU";
    case STATISTIC_BUNDES_AMT__SBA__IDENTIFIER = "AQV";
    case STATE_OR_PROVINCE_ASSIGNED_ENTITY_IDENTIFICATION = "AQW";
    case INSTITUTE_OF_SECURITY_AND_FUTURE_MARKET_DEVELOPMENT__ISFMD_ = "AQX";
    case FILE_IDENTIFICATION_NUMBER = "AQY";
    case BANKRUPTCY_PROCEDURE_NUMBER = "AQZ";
    case NATIONAL_GOVERNMENT_BUSINESS_IDENTIFICATION_NUMBER = "ARA";
    case PRIOR_DATA_UNIVERSAL_NUMBER_SYSTEM__DUNS__NUMBER = "ARB";
    case COMPANIES_REGISTRY_OFFICE__CRO__NUMBER = "ARC";
    case COSTA_RICAN_JUDICIAL_NUMBER = "ARD";
    case NUMERO_DE_IDENTIFICACION_TRIBUTARIA__NIT_ = "ARE";
    case PATRON_NUMBER = "ARF";
    case REGISTRO_INFORMACION_FISCAL__RIF__NUMBER = "ARG";
    case REGISTRO_UNICO_DE_CONTRIBUYENTE__RUC__NUMBER = "ARH";
    case TOKYO_SHOKO_RESEARCH__TSR__BUSINESS_IDENTIFIER = "ARI";
    case PERSONAL_IDENTITY_CARD_NUMBER = "ARJ";
    case SYSTEME_INFORMATIQUE_POUR_LE_REPERTOIRE_DES_ENTREPRISES = "ARK";
    case SYSTEME_INFORMATIQUE_POUR_LE_REPERTOIRE_DES_ETABLISSEMENTS = "ARL";
    case PUBLICATION_ISSUE_NUMBER = "ARM";
    case ORIGINAL_FILING_NUMBER = "ARN";
    case DOCUMENT_PAGE_IDENTIFIER = "ARO";
    case PUBLIC_FILING_REGISTRATION_NUMBER = "ARP";
    case REGIRISTO_FEDERAL_DE_CONTRIBUYENTES = "ARQ";
    case SOCIAL_SECURITY_NUMBER = "ARR";
    case DOCUMENT_VOLUME_NUMBER = "ARS";
    case BOOK_NUMBER = "ART";
    case STOCK_EXCHANGE_COMPANY_IDENTIFIER = "ARU";
    case IMPUTATION_ACCOUNT = "ARV";
    case FINANCIAL_PHASE_REFERENCE = "ARW";
    case TECHNICAL_PHASE_REFERENCE = "ARX";
    case PRIOR_CONTRACTOR_REGISTRATION_NUMBER = "ARY";
    case STOCK_ADJUSTMENT_NUMBER = "ARZ";
    case DISPENSATION_REFERENCE = "ASA";
    case INVESTMENT_REFERENCE_NUMBER = "ASB";
    case ASSUMING_COMPANY = "ASC";
    case BUDGET_CHAPTER = "ASD";
    case DUTY_FREE_PRODUCTS_SECURITY_NUMBER = "ASE";
    case DUTY_FREE_PRODUCTS_RECEIPT_AUTHORISATION_NUMBER = "ASF";
    case PARTY_INFORMATION_MESSAGE_REFERENCE = "ASG";
    case FORMAL_STATEMENT_REFERENCE = "ASH";
    case PROOF_OF_DELIVERY_REFERENCE_NUMBER = "ASI";
    case SUPPLIER_CREDIT_CLAIM_REFERENCE_NUMBER = "ASJ";
    case PICTURE_OF_ACTUAL_PRODUCT = "ASK";
    case PICTURE_OF_A_GENERIC_PRODUCT = "ASL";
    case TRADING_PARTNER_IDENTIFICATION_NUMBER = "ASM";
    case PRIOR_TRADING_PARTNER_IDENTIFICATION_NUMBER = "ASN";
    case PASSWORD = "ASO";
    case FORMAL_REPORT_NUMBER = "ASP";
    case FUND_ACCOUNT_NUMBER = "ASQ";
    case SAFE_CUSTODY_NUMBER = "ASR";
    case MASTER_ACCOUNT_NUMBER = "ASS";
    case GROUP_REFERENCE_NUMBER = "AST";
    case ACCOUNTING_TRANSMISSION_NUMBER = "ASU";
    case PRODUCT_DATA_FILE_NUMBER = "ASV";
    case CADASTRO_GERAL_DO_CONTRIBUINTE__CGC_ = "ASW";
    case FOREIGN_RESIDENT_IDENTIFICATION_NUMBER = "ASX";
    case CD_ROM = "ASY";
    case PHYSICAL_MEDIUM = "ASZ";
    case FINANCIAL_CANCELLATION_REFERENCE_NUMBER = "ATA";
    case PURCHASE_FOR_EXPORT_CUSTOMS_AGREEMENT_NUMBER = "ATB";
    case JUDGMENT_NUMBER = "ATC";
    case SECRETARIAT_NUMBER = "ATD";
    case PREVIOUS_BANKING_STATUS_MESSAGE_REFERENCE = "ATE";
    case LAST_RECEIVED_BANKING_STATUS_MESSAGE_REFERENCE = "ATF";
    case BANK_DOCUMENTARY_PROCEDURE_REFERENCE = "ATG";
    case CUSTOMER_DOCUMENTARY_PROCEDURE_REFERENCE = "ATH";
    case SAFE_DEPOSIT_BOX_NUMBER = "ATI";
    case RECEIVING_BANKGIRO_NUMBER = "ATJ";
    case SENDING_BANKGIRO_NUMBER = "ATK";
    case BANKGIRO_REFERENCE = "ATL";
    case GUARANTEE_NUMBER = "ATM";
    case COLLECTION_INSTRUMENT_NUMBER = "ATN";
    case CONVERTED_POSTGIRO_NUMBER = "ATO";
    case COST_CENTRE_ALIGNMENT_NUMBER = "ATP";
    case KAMER_VAN_KOOPHANDEL__KVK__NUMBER = "ATQ";
    case INSTITUT_BELGO_LUXEMBOURGEOIS_DE_CODIFICATION__IBLC__NUMBER = "ATR";
    case EXTERNAL_OBJECT_REFERENCE = "ATS";
    case EXCEPTIONAL_TRANSPORT_AUTHORISATION_NUMBER = "ATT";
    case CLAVE_UNICA_DE_IDENTIFICACION_TRIBUTARIA__CUIT_ = "ATU";
    case REGISTRO_UNICO_TRIBUTARIO__RUT_ = "ATV";
    case FLAT_RACK_CONTAINER_BUNDLE_IDENTIFICATION_NUMBER = "ATW";
    case TRANSPORT_EQUIPMENT_ACCEPTANCE_ORDER_REFERENCE = "ATX";
    case TRANSPORT_EQUIPMENT_RELEASE_ORDER_REFERENCE = "ATY";
    case SHIP_STAY_REFERENCE_NUMBER = "ATZ";
    case AUTHORIZATION_TO_MEET_COMPETITION_NUMBER = "AU";
    case PLACE_OF_POSITIONING_REFERENCE = "AUA";
    case PARTY_REFERENCE = "AUB";
    case ISSUED_PRESCRIPTION_IDENTIFICATION = "AUC";
    case COLLECTION_REFERENCE = "AUD";
    case TRAVEL_SERVICE = "AUE";
    case CONSIGNMENT_STOCK_CONTRACT = "AUF";
    case IMPORTER_LETTER_OF_CREDIT_REFERENCE = "AUG";
    case PERFORMED_PRESCRIPTION_IDENTIFICATION = "AUH";
    case IMAGE_REFERENCE = "AUI";
    case PROPOSED_PURCHASE_ORDER_REFERENCE_NUMBER = "AUJ";
    case APPLICATION_FOR_FINANCIAL_SUPPORT_REFERENCE_NUMBER = "AUK";
    case MANUFACTURING_QUALITY_AGREEMENT_NUMBER = "AUL";
    case SOFTWARE_EDITOR_REFERENCE = "AUM";
    case SOFTWARE_REFERENCE = "AUN";
    case SOFTWARE_QUALITY_REFERENCE = "AUO";
    case CONSOLIDATED_ORDERS_REFERENCE = "AUP";
    case CUSTOMS_BINDING_RULING_NUMBER = "AUQ";
    case CUSTOMS_NON_BINDING_RULING_NUMBER = "AUR";
    case DELIVERY_ROUTE_REFERENCE = "AUS";
    case NET_AREA_SUPPLIER_REFERENCE = "AUT";
    case TIME_SERIES_REFERENCE = "AUU";
    case CONNECTING_POINT_TO_CENTRAL_GRID = "AUV";
    case MARKETING_PLAN_IDENTIFICATION_NUMBER__MPIN_ = "AUW";
    case ENTITY_REFERENCE_NUMBER__PREVIOUS = "AUX";
    case INTERNATIONAL_STANDARD_INDUSTRIAL_CLASSIFICATION__ISIC_ = "AUY";
    case CUSTOMS_PRE_APPROVAL_RULING_NUMBER = "AUZ";
    case ACCOUNT_PAYABLE_NUMBER = "AV";
    case FIRST_FINANCIAL_INSTITUTION_TRANSACTION_REFERENCE = "AVA";
    case PRODUCT_CHARACTERISTICS_DIRECTORY = "AVB";
    case SUPPLIER_CUSTOMER_REFERENCE_NUMBER = "AVC";
    case INVENTORY_REPORT_REQUEST_NUMBER = "AVD";
    case METERING_POINT = "AVE";
    case PASSENGER_RESERVATION_NUMBER = "AVF";
    case SLAUGHTERHOUSE_APPROVAL_NUMBER = "AVG";
    case MEAT_CUTTING_PLANT_APPROVAL_NUMBER = "AVH";
    case CUSTOMER_TRAVEL_SERVICE_IDENTIFIER = "AVI";
    case EXPORT_CONTROL_CLASSIFICATION_NUMBER = "AVJ";
    case BROKER_REFERENCE_3 = "AVK";
    case CONSIGNMENT_INFORMATION = "AVL";
    case GOODS_ITEM_INFORMATION = "AVM";
    case DANGEROUS_GOODS_INFORMATION = "AVN";
    case PILOTAGE_SERVICES_EXEMPTION_NUMBER = "AVO";
    case PERSON_REGISTRATION_NUMBER = "AVP";
    case PLACE_OF_PACKING_APPROVAL_NUMBER = "AVQ";
    case ORIGINAL_MANDATE_REFERENCE = "AVR";
    case MANDATE_REFERENCE = "AVS";
    case RESERVATION_STATION_INDENTIFIER = "AVT";
    case UNIQUE_GOODS_SHIPMENT_IDENTIFIER = "AVU";
    case FRAMEWORK_AGREEMENT_NUMBER = "AVV";
    case HASH_VALUE = "AVW";
    case MOVEMENT_REFERENCE_NUMBER = "AVX";
    case ECONOMIC_OPERATORS_REGISTRATION_AND_IDENTIFICATION_NUMBER = "AVY";
    case LOCAL_REFERENCE_NUMBER = "AVZ";
    case RATE_CODE_NUMBER = "AWA";
    case AIR_WAYBILL_NUMBER = "AWB";
    case DOCUMENTARY_CREDIT_AMENDMENT_NUMBER = "AWC";
    case ADVISING_BANK_REFERENCE = "AWD";
    case COST_CENTRE = "AWE";
    case WORK_ITEM_QUANTITY_DETERMINATION = "AWF";
    case INTERNAL_DATA_PROCESS_NUMBER = "AWG";
    case CATEGORY_OF_WORK_REFERENCE = "AWH";
    case POLICY_FORM_NUMBER = "AWI";
    case NET_AREA = "AWJ";
    case SERVICE_PROVIDER = "AWK";
    case ERROR_POSITION = "AWL";
    case SERVICE_CATEGORY_REFERENCE = "AWM";
    case CONNECTED_LOCATION = "AWN";
    case RELATED_PARTY = "AWO";
    case LATEST_ACCOUNTING_ENTRY_RECORD_REFERENCE = "AWP";
    case ACCOUNTING_ENTRY = "AWQ";
    case DOCUMENT_REFERENCE__ORIGINAL = "AWR";
    case HYGIENIC_CERTIFICATE_NUMBER__NATIONAL = "AWS";
    case ADMINISTRATIVE_REFERENCE_CODE = "AWT";
    case PICK_UP_SHEET_NUMBER = "AWU";
    case PHONE_NUMBER = "AWV";
    case BUYER_FUND_NUMBER = "AWW";
    case COMPANY_TRADING_ACCOUNT_NUMBER = "AWX";
    case RESERVED_GOODS_IDENTIFIER = "AWY";
    case HANDLING_AND_MOVEMENT_REFERENCE_NUMBER = "AWZ";
    case INSTRUCTION_TO_DESPATCH_REFERENCE_NUMBER = "AXA";
    case INSTRUCTION_FOR_RETURNS_NUMBER = "AXB";
    case METERED_SERVICES_CONSUMPTION_REPORT_NUMBER = "AXC";
    case ORDER_STATUS_ENQUIRY_NUMBER = "AXD";
    case FIRM_BOOKING_REFERENCE_NUMBER = "AXE";
    case PRODUCT_INQUIRY_NUMBER = "AXF";
    case SPLIT_DELIVERY_NUMBER = "AXG";
    case SERVICE_RELATION_NUMBER = "AXH";
    case SERIAL_SHIPPING_CONTAINER_CODE = "AXI";
    case TEST_SPECIFICATION_NUMBER = "AXJ";
    case TRANSPORT_STATUS_REPORT_NUMBER = "AXK";
    case TOOLING_CONTRACT_NUMBER = "AXL";
    case FORMULA_REFERENCE_NUMBER = "AXM";
    case PRE_AGREEMENT_NUMBER = "AXN";
    case PRODUCT_CERTIFICATION_NUMBER = "AXO";
    case CONSIGNMENT_CONTRACT_NUMBER = "AXP";
    case PRODUCT_SPECIFICATION_REFERENCE_NUMBER = "AXQ";
    case PAYROLL_DEDUCTION_ADVICE_REFERENCE = "AXR";
    case TRACES_PARTY_IDENTIFICATION = "AXS";
    case BEGINNING_METER_READING_ACTUAL = "BA";
    case BUYER_CONTRACT_NUMBER = "BC";
    case BID_NUMBER = "BD";
    case BEGINNING_METER_READING_ESTIMATED = "BE";
    case HOUSE_BILL_OF_LADING_NUMBER = "BH";
    case BILL_OF_LADING_NUMBER = "BM";
    case CONSIGNMENT_IDENTIFIER__CARRIER_ASSIGNED = "BN";
    case BLANKET_ORDER_NUMBER = "BO";
    case BROKER_OR_SALES_OFFICE_NUMBER = "BR";
    case BATCH_NUMBER_LOT_NUMBER = "BT";
    case BATTERY_AND_ACCUMULATOR_PRODUCER_REGISTRATION_NUMBER = "BTP";
    case BLENDED_WITH_NUMBER = "BW";
    case IATA_CARGO_AGENT_CASS_ADDRESS_NUMBER = "CAS";
    case MATCHING_OF_ENTRIES__BALANCED = "CAT";
    case ENTRY_FLAGGING = "CAU";
    case MATCHING_OF_ENTRIES__UNBALANCED = "CAV";
    case DOCUMENT_REFERENCE__INTERNAL = "CAW";
    case EUROPEAN_VALUE_ADDED_TAX_IDENTIFICATION = "CAX";
    case COST_ACCOUNTING_DOCUMENT = "CAY";
    case GRID_OPERATOR_CUSTOMER_REFERENCE_NUMBER = "CAZ";
    case TICKET_CONTROL_NUMBER = "CBA";
    case ORDER_SHIPMENT_GROUPING_REFERENCE = "CBB";
    case CREDIT_NOTE_NUMBER = "CD";
    case CEDING_COMPANY = "CEC";
    case DEBIT_LETTER_NUMBER = "CED";
    case CONSIGNEE_FURTHER_ORDER = "CFE";
    case ANIMAL_FARM_LICENCE_NUMBER = "CFF";
    case CONSIGNOR_FURTHER_ORDER = "CFO";
    case CONSIGNEE_ORDER_NUMBER = "CG";
    case CUSTOMER_CATALOGUE_NUMBER = "CH";
    case CHEQUE_NUMBER = "CK";
    case CHECKING_NUMBER = "CKN";
    case CREDIT_MEMO_NUMBER = "CM";
    case ROAD_CONSIGNMENT_NOTE_NUMBER = "CMR";
    case CARRIER_REFERENCE_NUMBER = "CN";
    case CHARGES_NOTE_DOCUMENT_ATTACHMENT_INDICATOR = "CNO";
    case CALL_OFF_ORDER_NUMBER = "COF";
    case CONDITION_OF_PURCHASE_DOCUMENT_NUMBER = "CP";
    case CUSTOMER_REFERENCE_NUMBER = "CR";
    case TRANSPORT_MEANS_JOURNEY_IDENTIFIER = "CRN";
    case CONDITION_OF_SALE_DOCUMENT_NUMBER = "CS";
    case TEAM_ASSIGNMENT_NUMBER = "CST";
    case CONTRACT_NUMBER = "CT";
    case CONSIGNMENT_IDENTIFIER__CONSIGNOR_ASSIGNED = "CU";
    case CONTAINER_OPERATORS_REFERENCE_NUMBER = "CV";
    case PACKAGE_NUMBER = "CW";
    case COOPERATION_CONTRACT_NUMBER = "CZ";
    case DEFERMENT_APPROVAL_NUMBER = "DA";
    case DEBIT_ACCOUNT_NUMBER = "DAN";
    case BUYER_DEBTOR_NUMBER = "DB";
    case DISTRIBUTOR_INVOICE_NUMBER = "DI";
    case DEBIT_NOTE_NUMBER = "DL";
    case DOCUMENT_IDENTIFIER = "DM";
    case DELIVERY_NOTE_NUMBER = "DQ";
    case DOCK_RECEIPT_NUMBER = "DR";
    case ENDING_METER_READING_ACTUAL = "EA";
    case EMBARGO_PERMIT_NUMBER = "EB";
    case EXPORT_DECLARATION = "ED";
    case ENDING_METER_READING_ESTIMATED = "EE";
    case ELECTRICAL_AND_ELECTRONIC_EQUIPMENT_PRODUCER_REGISTRATION = "EEP";
    case EMPLOYER_IDENTIFICATION_NUMBER = "EI";
    case EMBARGO_NUMBER = "EN";
    case EQUIPMENT_NUMBER = "EQ";
    case CONTAINER_EQUIPMENT_RECEIPT_NUMBER = "ER";
    case EXPORTER_REFERENCE_NUMBER = "ERN";
    case EXCESS_TRANSPORTATION_NUMBER = "ET";
    case EXPORT_PERMIT_IDENTIFIER = "EX";
    case FISCAL_NUMBER = "FC";
    case CONSIGNMENT_IDENTIFIER__FREIGHT_FORWARDER_ASSIGNED = "FF";
    case FILE_LINE_IDENTIFIER = "FI";
    case FLOW_REFERENCE_NUMBER = "FLW";
    case FREIGHT_BILL_NUMBER = "FN";
    case FOREIGN_EXCHANGE = "FO";
    case FINAL_SEQUENCE_NUMBER = "FS";
    case FREE_ZONE_IDENTIFIER = "FT";
    case FILE_VERSION_NUMBER = "FV";
    case FOREIGN_EXCHANGE_CONTRACT_NUMBER = "FX";
    case STANDARD_NUMBER = "GA";
    case GOVERNMENT_CONTRACT_NUMBER = "GC";
    case STANDARD_CODE_NUMBER = "GD";
    case GENERAL_DECLARATION_NUMBER = "GDN";
    case GOVERNMENT_REFERENCE_NUMBER = "GN";
    case HARMONISED_SYSTEM_NUMBER = "HS";
    case HOUSE_WAYBILL_NUMBER = "HWB";
    case INTERNAL_VENDOR_NUMBER = "IA";
    case IN_BOND_NUMBER = "IB";
    case IATA_CARGO_AGENT_CODE_NUMBER = "ICA";
    case INSURANCE_CERTIFICATE_REFERENCE_NUMBER = "ICE";
    case INSURANCE_CONTRACT_REFERENCE_NUMBER = "ICO";
    case INITIAL_SAMPLE_INSPECTION_REPORT_NUMBER = "II";
    case INTERNAL_ORDER_NUMBER = "IL";
    case INTERMEDIARY_BROKER = "INB";
    case INTERCHANGE_NUMBER_NEW = "INN";
    case INTERCHANGE_NUMBER_OLD = "INO";
    case IMPORT_PERMIT_IDENTIFIER = "IP";
    case INVOICE_NUMBER_SUFFIX = "IS";
    case INTERNAL_CUSTOMER_NUMBER = "IT";
    case INVOICE_DOCUMENT_IDENTIFIER = "IV";
    case JOB_NUMBER = "JB";
    case ENDING_JOB_SEQUENCE_NUMBER = "JE";
    case SHIPPING_LABEL_SERIAL_NUMBER = "LA";
    case LOADING_AUTHORISATION_IDENTIFIER = "LAN";
    case LOWER_NUMBER_IN_RANGE = "LAR";
    case LOCKBOX = "LB";
    case LETTER_OF_CREDIT_NUMBER = "LC";
    case DOCUMENT_LINE_IDENTIFIER = "LI";
    case LOAD_PLANNING_NUMBER = "LO";
    case RESERVATION_OFFICE_IDENTIFIER = "LRC";
    case BAR_CODED_LABEL_SERIAL_NUMBER = "LS";
    case SHIP_NOTICE_MANIFEST_NUMBER = "MA";
    case MASTER_BILL_OF_LADING_NUMBER = "MB";
    case MANUFACTURER_PART_NUMBER = "MF";
    case METER_UNIT_NUMBER = "MG";
    case MANUFACTURING_ORDER_NUMBER = "MH";
    case MESSAGE_RECIPIENT = "MR";
    case MAILING_REFERENCE_NUMBER = "MRN";
    case MESSAGE_SENDER = "MS";
    case MANUFACTURER_MATERIAL_SAFETY_DATA_SHEET_NUMBER = "MSS";
    case MASTER_AIR_WAYBILL_NUMBER = "MWB";
    case NORTH_AMERICAN_HAZARDOUS_GOODS_CLASSIFICATION_NUMBER = "NA";
    case NOTA_FISCAL = "NF";
    case CURRENT_INVOICE_NUMBER = "OH";
    case PREVIOUS_INVOICE_NUMBER = "OI";
    case ORDER_DOCUMENT_IDENTIFIER__BUYER_ASSIGNED = "ON";
    case ORIGINAL_PURCHASE_ORDER = "OP";
    case GENERAL_ORDER_NUMBER = "OR";
    case PAYER_FINANCIAL_INSTITUTION_ACCOUNT_NUMBER = "PB";
    case PRODUCTION_CODE = "PC";
    case PROMOTION_DEAL_NUMBER = "PD";
    case PLANT_NUMBER = "PE";
    case PRIME_CONTRACTOR_CONTRACT_NUMBER = "PF";
    case PRICE_LIST_VERSION_NUMBER = "PI";
    case PACKING_LIST_NUMBER = "PK";
    case PRICE_LIST_NUMBER = "PL";
    case PURCHASE_ORDER_RESPONSE_NUMBER = "POR";
    case PURCHASE_ORDER_CHANGE_NUMBER = "PP";
    case PAYMENT_REFERENCE = "PQ";
    case PRICE_QUOTE_NUMBER = "PR";
    case PURCHASE_ORDER_NUMBER_SUFFIX = "PS";
    case PRIOR_PURCHASE_ORDER_NUMBER = "PW";
    case PAYEE_FINANCIAL_INSTITUTION_ACCOUNT_NUMBER = "PY";
    case REMITTANCE_ADVICE_NUMBER = "RA";
    case RAIL_ROAD_ROUTING_CODE = "RC";
    case RAILWAY_CONSIGNMENT_NOTE_NUMBER = "RCN";
    case RELEASE_NUMBER = "RE";
    case CONSIGNMENT_RECEIPT_IDENTIFIER = "REN";
    case EXPORT_REFERENCE_NUMBER = "RF";
    case PAYER_FINANCIAL_INSTITUTION_TRANSIT_ROUTING_NO__ACH = "RR";
    case PAYEE_FINANCIAL_INSTITUTION_TRANSIT_ROUTING_NO_ = "RT";
    case SALES_PERSON_NUMBER = "SA";
    case SALES_REGION_NUMBER = "SB";
    case SALES_DEPARTMENT_NUMBER = "SD";
    case SERIAL_NUMBER = "SE";
    case ALLOCATED_SEAT = "SEA";
    case SHIP_FROM = "SF";
    case PREVIOUS_HIGHEST_SCHEDULE_NUMBER = "SH";
    case SID__SHIPPER_IDENTIFYING_NUMBER_FOR_SHIPMENT_ = "SI";
    case SALES_OFFICE_NUMBER = "SM";
    case TRANSPORT_EQUIPMENT_SEAL_IDENTIFIER = "SN";
    case SCAN_LINE = "SP";
    case EQUIPMENT_SEQUENCE_NUMBER = "SQ";
    case SHIPMENT_REFERENCE_NUMBER = "SRN";
    case SELLERS_REFERENCE_NUMBER = "SS";
    case STATION_REFERENCE_NUMBER = "STA";
    case SWAP_ORDER_NUMBER = "SW";
    case SPECIFICATION_NUMBER = "SZ";
    case TRUCKER_BILL_OF_LADING = "TB";
    case TERMINAL_OPERATOR_CONSIGNMENT_REFERENCE = "TCR";
    case TELEX_MESSAGE_NUMBER = "TE";
    case TRANSFER_NUMBER = "TF";
    case TIR_CARNET_NUMBER = "TI";
    case TRANSPORT_INSTRUCTION_NUMBER = "TIN";
    case TAX_EXEMPTION_LICENCE_NUMBER = "TL";
    case TRANSACTION_REFERENCE_NUMBER = "TN";
    case TEST_REPORT_NUMBER = "TP";
    case UPPER_NUMBER_OF_RANGE = "UAR";
    case ULTIMATE_CUSTOMER_REFERENCE_NUMBER = "UC";
    case UNIQUE_CONSIGNMENT_REFERENCE_NUMBER = "UCN";
    case UNITED_NATIONS_DANGEROUS_GOODS_IDENTIFIER = "UN";
    case ULTIMATE_CUSTOMER_ORDER_NUMBER = "UO";
    case UNIFORM_RESOURCE_IDENTIFIER = "URI";
    case VAT_REGISTRATION_NUMBER = "VA";
    case VENDOR_CONTRACT_NUMBER = "VC";
    case TRANSPORT_EQUIPMENT_GROSS_MASS_VERIFICATION_REFERENCE = "VGR";
    case VESSEL_IDENTIFIER = "VM";
    case ORDER_NUMBER__VENDOR_ = "VN";
    case VOYAGE_NUMBER = "VON";
    case TRANSPORT_EQUIPMENT_GROSS_MASS_VERIFICATION_ORDER_REFERENCE = "VOR";
    case VENDOR_PRODUCT_NUMBER = "VP";
    case VENDOR_ID_NUMBER = "VR";
    case VENDOR_ORDER_NUMBER_SUFFIX = "VS";
    case MOTOR_VEHICLE_IDENTIFICATION_NUMBER = "VT";
    case VOUCHER_NUMBER = "VV";
    case WAREHOUSE_ENTRY_NUMBER = "WE";
    case WEIGHT_AGREEMENT_NUMBER = "WM";
    case WELL_NUMBER = "WN";
    case WAREHOUSE_RECEIPT_NUMBER = "WR";
    case WAREHOUSE_STORAGE_LOCATION_NUMBER = "WS";
    case RAIL_WAYBILL_NUMBER = "WY";
    case COMPANY_PLACE_REGISTRATION_NUMBER = "XA";
    case CARGO_CONTROL_NUMBER = "XC";
    case PREVIOUS_CARGO_CONTROL_NUMBER = "XP";
    case MUTUALLY_DEFINED_REFERENCE_NUMBER = "ZZZ";
}
