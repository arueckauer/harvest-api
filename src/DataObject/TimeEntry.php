<?php

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;

class TimeEntry extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     * @todo DateTime
     */
    public $spentDate;

    /**
     * @var Reference\Creator
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Creator")
     */
    public $user;

    /**
     * @var Reference\ProjectUserAssignment
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\ProjectUserAssignment")
     */
    public $userAssignment;

    /**
     * @var Reference\Client
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Client")
     */
    public $client;

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
     * @var Reference\ProjectTaskAssignment
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\ProjectTaskAssignment")
     */
    public $taskAssignment;

    /**
     * @var Reference\ExternalReference
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\ExternalReference")
     */
    public $externalReference;

    /**
     * @var Reference\Invoice
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Invoice")
     */
    public $invoice;

    /**
     * @var float
     */
    public $hours;

    /**
     * @var string
     */
    public $notes;

    /**
     * @var bool
     */
    public $isLocked;

    /**
     * @var string
     */
    public $lockedReason;

    /**
     * @var bool
     */
    public $isClosed;

    /**
     * @var bool
     */
    public $isBilled;

    /**
     * @var string
     * @todo DateTime
     */
    public $timerStartedAt;

    /**
     * @var string
     */
    public $startedTime;

    /**
     * @var string
     */
    public $endedTime;

    /**
     * @var bool
     */
    public $isRunning;

    /**
     * @var bool
     */
    public $billable;

    /**
     * @var bool
     */
    public $budgeted;

    /**
     * @var float
     */
    public $billableRate;

    /**
     * @var float
     */
    public $costRate;

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
