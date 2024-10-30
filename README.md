# Factur-X PHP Library

## Install with Composer

```bash
composer require tiime/factur-x
```

## Usage

### Generate Factur-X

Create a Factur-X compliant PDF document by merging provided PDF content with XML data and optionally adding a logo.

```php
use Tiime\FacturX\Writer;

$writer = new Writer();
$facturxContent = $writer->generate(
    pdfContent: $pdfContent,
    xmlContent: $xml,
    addLogo: true
);

file_put_contents('generated_facturx.pdf', $facturxContent);
```

### Extract XML from Factur-X

Extract XML data from a Factur-X compliance PDF document.

```php
use Tiime\FacturX\Reader;

$extractedXml = (new Reader())->extractXML($writer);
```