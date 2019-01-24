<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;

class InvoiceMessage extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $sentBy;

    /**
     * @var string
     */
    public $sentByEmail;

    /**
     * @var string
     */
    public $sentFrom;

    /**
     * @var string
     */
    public $sentFromEmail;

    /**
     * @var Collection\InvoiceMessageRecipient
     */
    public $recipients;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $body;

    /**
     * @var bool
     */
    public $includeLinkToClientInvoice;

    /**
     * @var bool
     */
    public $attachPdf;

    /**
     * @var bool
     */
    public $sendMeACopy;

    /**
     * @var bool
     */
    public $thankYou;

    /**
     * @var string
     */
    public $eventType;

    /**
     * @var bool
     */
    public $reminder;

    /**
     * @var \DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $sendReminderOn;

    /**
     * @var \DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $createdAt;

    /**
     * @var \DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $updatedAt;
}
