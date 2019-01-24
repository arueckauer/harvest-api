<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Reference;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;

class PaymentGateway extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;
}
