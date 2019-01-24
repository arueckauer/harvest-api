<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Reference;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;

class Receipt extends AbstractDataObject
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $fileName;
}
