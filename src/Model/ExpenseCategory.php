<?php

namespace arueckauer\HarvestApi\Model;

class ExpenseCategory extends AbstractModel
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
