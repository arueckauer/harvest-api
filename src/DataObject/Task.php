<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;
use DateTimeImmutable;

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
