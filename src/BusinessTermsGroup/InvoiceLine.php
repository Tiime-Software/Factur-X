<?php

namespace Tiime\FacturX\BusinessTermsGroup;

use Tiime\FacturX\DataType\Identifier;

/**
 * BG-25
 * A group of business terms providing information on individual Invoice lines.
 *
 * Groupe de termes métiers fournissant des informations sur les lignes de Facture individuelles.
 */
class InvoiceLine
{
    /**
     * BT-126
     * A unique identifier for the individual line within the Invoice.
     *
     * Identifiant unique d'une ligne au sein de la Facture.
     */
    private Identifier $identifier;

    /**
     * BT-127
     * A textual note that gives unstructured information that is relevant to the Invoice line.
     *
     * Commentaire fournissant des informations non structurées concernant la ligne de Facture.
     */
    private ?string $note;

    /**
     * BT-128
     * @todo english desc
     *
     * Identifiant d'un objet sur lequel est basée la ligne de facture et qui est indiqué par le Vendeur.
     * Il peut s'agir d'un numéro d'abonnement, d'un numéro de téléphone, d'un compteur, etc., selon le cas.
     * Si le schéma utilisé pour l'identifiant n'est pas clair pour le destinataire,
     * il convient d'utiliser un identifiant de schéma conditionnel qui doit être choisi parmi
     * les codes de la liste de codes de la donnée 1153 du dictionnaire des données UNTDID.
     */
    private ?Identifier $objectIdentifier;

    /**
     * BT-129
     * The quantity of items (goods or services) that is charged in the Invoice line.
     *
     * Quantité d'articles (biens ou services) facturée prise en compte dans la ligne de Facture.
     *
     * @var
     */
    private $invoicedQuantity;

    /**
     * BT-130
     * The unit of measure that applies to the invoiced quantity.
     *
     * Unité de mesure applicable à la quantité facturée.
     *
     * @var
     */
    private $invoicedQuantityUnitOfMeasureCode;

    /**
     * BT-131
     * The total amount of the Invoice line.
     *
     * Montant total de la ligne de Facture.
     */
    private float $netAmount;

    /**
     * BT-132
     * An identifier for a referenced line within a purchase order, issued by the Buyer.
     *
     * Identifiant d'une ligne d'un bon de commande référencée, généré par l'Acheteur.
     */
    private ?string $referencedPurchaseOrderLineReference;

    /**
     * BT-133
     * A textual value that specifies where to book the relevant data into the Buyer's financial accounts.
     *
     * Valeur textuelle spécifiant où imputer les données pertinentes dans les comptes comptables de l'Acheteur.
     */
    private ?string $buyerAccountingReference;

    /**
     * @var InvoiceLineCharges[]
     */
    private $charges;

    /**
     * @var InvoiceLineAllowances[]
     */
    private $allowances;
    /**
     * @var InvoiceLinePeriod|null
     */
    private $period;

    public function __construct(Identifier $identifier, float $netAmount)
    {
        $this->identifier = $identifier;
        $this->netAmount = $netAmount;
    }

    public function getNetAmount(): float
    {
        return $this->netAmount;
    }

    public function hydrateXmlDocument(\DOMDocument $document): void
    {
        $supplyChainTradeTransaction = $document->getElementsByTagName('rsm:SupplyChainTradeTransaction')->item(0);


        $includedSupplyChainTradeLineItem = $document->createElement('ram:IncludedSupplyChainTradeLineItem');

        $associatedDocumentLineDocument = $document->createElement('ram:AssociatedDocumentLineDocument');
        $associatedDocumentLineDocument->appendChild($document->createElement('ram:LineID', $this->identifier->value));
        $includedSupplyChainTradeLineItem->appendChild($associatedDocumentLineDocument);

        $supplyChainTradeTransaction->appendChild($includedSupplyChainTradeLineItem);
    }
}
