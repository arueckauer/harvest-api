<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;
use DateTimeImmutable;

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
     * @var int
     */
    public $projectId;

    /**
     * @var Reference\Project
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Project")
     */
    public $project;

    /**
     * @var int
     */
    public $expenseCategoryId;

    /**
     * @var Reference\ExpenseCategory
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\ExpenseCategory")
     */
    public $expenseCategory;

    /**
     * @var int
     */
    public $userId;

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
     * @var DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
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
