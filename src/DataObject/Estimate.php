<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;
use DateTimeImmutable;

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
     * @var Collection\EstimateLineItem
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
     * @var DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $issueDate;

    /**
     * @var DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $sentAt;

    /**
     * @var DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $acceptedAt;

    /**
     * @var DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $declinedAt;

    /**
     * @var DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $createdAt;

    /**
     * @var DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $updatedAt;
}
