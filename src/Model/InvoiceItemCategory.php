<?php

namespace arueckauer\Harvest\Model;

class InvoiceItemCategory extends AbstractModel
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
    public $useAsService;

    /**
     * @var bool
     */
    public $useAsExpense;

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
