<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;
use DateTimeImmutable;

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
     * @var DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $createdAt;

    /**
     * @var DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $updatedAt;
}
