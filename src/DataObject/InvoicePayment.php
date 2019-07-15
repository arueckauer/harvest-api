<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;
use DateTimeImmutable;

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
     * @var DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $paidAt;

    /**
     * @var DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
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
