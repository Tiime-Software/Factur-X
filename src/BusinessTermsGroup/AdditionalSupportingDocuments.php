<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-24
 * A group of business terms providing information about additional supporting documents substantiating
 * the claims made in the Invoice.
 */
class AdditionalSupportingDocuments
{
    /**
     * BT-122
     * An identifier of the supporting document.
     *
     * @var
     */
    private $reference;

    /**
     * BT-123
     * A description of the supporting document.
     *
     * @var
     */
    private $description;

    /**
     * BT-124
     * The URL (Uniform Resource Locator) that identifies where the external document is located.
     *
     * @var
     */
    private $externalDocumentLocation;

    /**
     * BT-125
     * An attached document embedded as binary object or sent together with the invoice.
     * @todo
     * @var
     */
    private $attachedDocument;
}
