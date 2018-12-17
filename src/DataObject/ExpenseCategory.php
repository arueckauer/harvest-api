<?php

namespace arueckauer\HarvestApi\DataObject;

class ExpenseCategory extends AbstractDataObject
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
     * @var string
     */
    public $unitName;

    /**
     * @var float
     */
    public $unitPrice;

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
