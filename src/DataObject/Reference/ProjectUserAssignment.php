<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Reference;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\PropertyReference;
use DateTimeImmutable;

class ProjectUserAssignment extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var bool
     */
    public $isProjectManager;

    /**
     * @var bool
     */
    public $isActive;

    /**
     * @var float|null
     */
    public $budget;

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

    /**
     * @var float|null
     */
    public $hourlyRate;
}
