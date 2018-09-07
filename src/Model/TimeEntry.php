<?php

namespace arueckauer\Harvest\Model;

class TimeEntry extends AbstractModel
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
     * @var User
     */
    public $user;

    /**
     * @var ProjectUserAssignment
     */
    public $userAssignment;

    /**
     * @var Client
     */
    public $client;

    /**
     * @var Project
     */
    public $project;

    /**
     * @var Task
     */
    public $task;

    /**
     * @var ProjectTaskAssignment
     */
    public $taskAssignment;

    /**
     * @var object
     * @todo Define class
     */
    public $externalReference;

    /**
     * @var Invoice
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
