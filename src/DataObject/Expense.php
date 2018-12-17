<?php

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;

class Expense extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

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
     * @var Reference\ExpenseCategory
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\ExpenseCategory")
     */
    public $expenseCategory;

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
     * @var Reference\Receipt
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Receipt")
     */
    public $receipt;

    /**
     * @var Reference\Invoice
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Invoice")
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
