<?php

namespace arueckauer\Harvest\Model;

class InvoicePayment extends AbstractModel
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
     * @var object
     * @todo Define class
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
