<?php

namespace arueckauer\HarvestApi\DataObject;

class Task extends AbstractDataObject
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
    public $billableByDefault;

    /**
     * @var float
     */
    public $defaultHourlyRate;

    /**
     * @var bool
     */
    public $isDefault;

    /**
     * @var bool
     */
    public $isActive;

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
