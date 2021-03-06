<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject;

class EstimateLineItem extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $kind;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $quantity;

    /**
     * @var float
     */
    public $unitPrice;

    /**
     * @var float
     */
    public $amount;

    /**
     * @var bool
     */
    public $taxed;

    /**
     * @var bool
     */
    public $taxed2;
}
