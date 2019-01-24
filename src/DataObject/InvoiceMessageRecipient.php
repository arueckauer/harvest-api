<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject;

class InvoiceMessageRecipient extends AbstractDataObject
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;
}
