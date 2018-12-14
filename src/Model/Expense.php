<?php

namespace arueckauer\HarvestApi\Model;

use arueckauer\HarvestApi\PropertyReference;

class Expense extends AbstractModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var Client
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\Model\Client")
     */
    public $client;

    /**
     * @var Project
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\Model\Project")
     */
    public $project;

    /**
     * @var ExpenseCategory
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\Model\ExpenseCategory")
     */
    public $expenseCategory;

    /**
     * @var User
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\Model\User")
     */
    public $user;

    /**
     * @var ProjectUserAssignment
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\Model\ProjectUserAssignment")
     */
    public $userAssignment;

    /**
     * @var object
     * @todo Define class
     */
    public $receipt;

    /**
     * @var Invoice
     */
    public $invoice;

    /**
     * @var string
     */
    public $notes;

    /**
     * @var bool
     */
    public $billable;

    /**
     * @var bool
     */
    public $isClosed;

    /**
     * @var bool
     */
    public $isLocked;

    /**
     * @var bool
     */
    public $isBilled;

    /**
     * @var string
     */
    public $lockedReason;

    /**
     * @var string
     * @todo DateTime
     */
    public $spentDate;

    /**
     * @var float
     */
    public $totalCost;

    /**
     * @var int
     */
    public $units;

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
