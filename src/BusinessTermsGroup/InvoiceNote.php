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
     */
    private ?InvoiceNoteCode $subjectCode;

    /**
     * BT-22
     * A textual note that gives unstructured information that is relevant to the Invoice as a whole.
     */
    private string $note;

    public function __construct(string $note)
    {
        $this->subjectCode = null;
        $this->note = $note;
    }

    public function getSubjectCode(): ?InvoiceNoteCode
    {
        return $this->subjectCode;
    }

    public function setSubjectCode(?InvoiceNoteCode $subjectCode): self
    {
        $this->subjectCode = $subjectCode;

        return $this;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function hydrateXmlDocument(\DOMDocument $document): void
    {
        $exchangedDocument = $document->getElementsByTagName('rsm:ExchangedDocument')->item(0);

        if (!$exchangedDocument instanceof \DOMNode) {
            throw new \RuntimeException();
        }

        $note = $document->createElement('ram:IncludedNote');
        $note->appendChild($document->createElement('ram:Content', $this->note));

        if ($this->subjectCode instanceof InvoiceNoteCode) {
            $note->appendChild($document->createElement('ram:SubjectCode', $this->subjectCode->value));
        }

        $exchangedDocument->appendChild($note);
    }
}
