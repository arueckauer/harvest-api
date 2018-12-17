<?php

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;

class UserProjectAssignment extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var bool
     */
    public $isActive;

    /**
     * @var bool
     */
    public $isProjectManager;

    /**
     * @var float
     */
    public $hourlyRate;

    /**
     * @var float
     */
    public $budget;

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

    /**
     * @var Reference\Project
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Project")
     */
    public $project;

    /**
     * @var Reference\Creator
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Creator")
     */
    public $user;

    /**
     * @var \arueckauer\HarvestApi\DataObject\Collection\ProjectTaskAssignment
     */
    public $taskAssignments;
}
