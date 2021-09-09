<?php

namespace Tiime\FacturX\BusinessTermsGroup;

/**
 * BG-1
 * A group of business terms providing textual notes that are relevant for the invoice,
 * together with an indication of the note subject.
 */
class InvoiceNote
{
    /**
     * BT-21
     * The subject of the textual note in BT-22.
     *
     * @var
     */
    private $subjectCode;

    /**
     * BT-22
     * A textual note that gives unstructured information that is relevant to the Invoice as a whole.
     *
     * @var string
     */
    private $note;

    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    public function getNote(): string
    {
        return $this->note;
    }
}
