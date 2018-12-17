<?php

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;

class Invoice extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var Reference\Client
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Client")
     */
    public $client;

    /**
     * @var Collection\InvoiceLineItem
     */
    public $lineItems;

    /**
     * @var Reference\Estimate
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Estimate")
     */
    public $estimate;

    /**
     * @var Reference\Retainer
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Retainer")
     */
    public $retainer;

    /**
     * @var Reference\Creator
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Creator")
     */
    public $creator;

    /**
     * @var string
     */
    public $clientKey;

    /**
     * @var string
     */
    public $http;

    /**
     * @var string
     */
    public $number;

    /**
     * @var string
     */
    public $purchaseOrder;

    /**
     * @var float
     */
    public $amount;

    /**
     * @var float
     */
    public $dueAmount;

    /**
     * @var float
     */
    public $tax;

    /**
     * @var float
     */
    public $taxAmount;

    /**
     * @var float
     */
    public $tax2;

    /**
     * @var float
     */
    public $tax2Amount;

    /**
     * @var float
     */
    public $discount;

    /**
     * @var float
     */
    public $discountAmount;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $notes;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var string
     */
    public $state;

    /**
     * @var string
     * @todo DateTime
     */
    public $periodStart;

    /**
     * @var string
     * @todo DateTime
     */
    public $periodEnd;

    /**
     * @var string
     * @todo DateTime
     */
    public $issueDate;

    /**
     * @var string
     * @todo DateTime
     */
    public $dueDate;

    /**
     * @var string
     */
    public $paymentTerm;

    /**
     * @var string
     * @todo DateTime
     */
    public $sentAt;

    /**
     * @var string
     * @todo DateTime
     */
    public $paidAt;

    /**
     * @var string
     * @todo DateTime
     */
    public $paidDate;

    /**
     * @var string
     * @todo DateTime
     */
    public $closedAt;

    /**
     * @var string
     * @todo DateTime
     */
    public $createdAt;

    /**
     * @var string
     * @todo DateTime
     */
    public $updatedAt;
}
