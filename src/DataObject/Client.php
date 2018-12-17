<?php

namespace arueckauer\HarvestApi\DataObject;

class Client extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var bool
     */
    public $isActive;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $currency;

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
