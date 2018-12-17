<?php

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\DataObject\Reference\Receipt;
use arueckauer\HarvestApi\PropertyReference;

class Expense extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var Client
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Client")
     */
    public $client;

    /**
     * @var Project
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Project")
     */
    public $project;

    /**
     * @var ExpenseCategory
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\ExpenseCategory")
     */
    public $expenseCategory;

    /**
     * @var User
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\User")
     */
    public $user;

    /**
     * @var ProjectUserAssignment
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\ProjectUserAssignment")
     */
    public $userAssignment;

    /**
     * @var Receipt
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Receipt")
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
