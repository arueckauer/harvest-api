<?php

namespace arueckauer\Harvest\Model;

class InvoiceMessage extends AbstractModel
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
     * @var InvoiceMessageRecipient[]
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
     * @var string
     * @todo DateTime
     */
    public $sendReminderOn;

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
