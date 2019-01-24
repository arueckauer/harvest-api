<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject;

class EstimateMessageRecipient extends AbstractDataObject
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
