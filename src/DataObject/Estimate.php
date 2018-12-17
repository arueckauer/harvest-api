<?php

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;

class Estimate extends AbstractDataObject
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
     * @var \arueckauer\HarvestApi\DataObject\Collection\EstimateLineItem
     */
    public $lineItems;

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
    public $issueDate;

    /**
     * @var string
     * @todo DateTime
     */
    public $sentAt;

    /**
     * @var string
     * @todo DateTime
     */
    public $acceptedAt;

    /**
     * @var string
     * @todo DateTime
     */
    public $declinedAt;

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
