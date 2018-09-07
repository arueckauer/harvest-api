<?php

namespace arueckauer\Harvest\Model;

class Estimate extends AbstractModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var Client
     */
    public $client;

    /**
     * @var \arueckauer\Harvest\Collection\EstimateLineItem
     */
    public $lineItems;

    /**
     * @var object
     * @Todo Define class
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
