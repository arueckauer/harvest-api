<?php

namespace arueckauer\HarvestApi\DataObject\Reference;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;

class ExternalReference extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $groupId;

    /**
     * @var string
     */
    public $permalink;

    /**
     * @var string
     */
    public $service;

    /**
     * @var string
     */
    public $serviceIconUrl;
}
