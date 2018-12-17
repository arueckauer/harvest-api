<?php

namespace arueckauer\HarvestApi\DataObject;

class InvoiceLineItem extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var Project
     */
    public $project;

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
