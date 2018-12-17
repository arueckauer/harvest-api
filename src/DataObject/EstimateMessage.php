<?php

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;

class EstimateMessage extends AbstractDataObject
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
     * @var Collection\EstimateMessageRecipient
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
    public $sendMeACopy;

    /**
     * @var string
     */
    public $eventType;

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
