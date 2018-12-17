<?php

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;

class InvoicePayment extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var float
     */
    public $amount;

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
     */
    public $recordedBy;

    /**
     * @var string
     */
    public $recordedByEmail;

    /**
     * @var string
     */
    public $notes;

    /**
     * @var string
     */
    public $transactionId;

    /**
     * @var Reference\PaymentGateway
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\PaymentGateway")
     */
    public $paymentGateway;

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
