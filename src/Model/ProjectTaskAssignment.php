<?php

namespace arueckauer\Harvest\Model;

class ProjectTaskAssignment extends AbstractModel
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
     * @var Task
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
