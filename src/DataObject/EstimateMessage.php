<?php

namespace arueckauer\HarvestApi\DataObject;

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
     * @var \arueckauer\HarvestApi\DataObject\Collection\EstimateMessageRecipient
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
