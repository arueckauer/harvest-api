<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;
use DateTimeImmutable;

class ProjectTaskAssignment extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var Reference\Project
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Project")
     */
    public $project;

    /**
     * @var Reference\Task
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Task")
     */
    public $task;

    /**
     * @var bool
     */
    public $isActive;

    /**
     * @var bool
     */
    public $billable;

    /**
     * @var float
     */
    public $hourlyRate;

    /**
     * @var float
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
}
