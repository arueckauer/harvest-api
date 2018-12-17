<?php

namespace arueckauer\HarvestApi\DataObject\Reference;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;

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
     * @var string
     */
    public $createdAt;

    /**
     * @var string
     */
    public $updatedAt;

    /**
     * @var float|null
     */
    public $hourlyRate;
}
