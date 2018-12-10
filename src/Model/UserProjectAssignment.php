<?php

namespace arueckauer\HarvestApi\Model;

class UserProjectAssignment extends AbstractModel
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
     * @var Project
     */
    public $project;

    /**
     * @var User
     */
    public $user;

    /**
     * @var \arueckauer\HarvestApi\Collection\ProjectTaskAssignment
     */
    public $taskAssignments;
}
