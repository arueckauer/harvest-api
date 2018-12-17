<?php

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\PropertyReference;

class Project extends AbstractDataObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $clientId;

    /**
     * @var Reference\Client
     * @PropertyReference(isReference=true, class="arueckauer\HarvestApi\DataObject\Reference\Client")
     */
    public $client;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $code;

    /**
     * @var bool
     */
    public $isActive;

    /**
     * @var bool
     */
    public $isBillable;

    /**
     * @var bool
     */
    public $isFixedFee;

    /**
     * @var string
     */
    public $billBy;

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
     */
    public $budgetBy;

    /**
     * @var bool
     */
    public $budgetIsMonthly;

    /**
     * @var bool
     */
    public $notifyWhenOverBudget;

    /**
     * @var float
     */
    public $overBudgetNotificationPercentage;

    /**
     * @var \DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $overBudgetNotificationDate;

    /**
     * @var bool
     */
    public $showBudgetToAll;

    /**
     * @var float
     */
    public $costBudget;

    /**
     * @var bool
     */
    public $costBudgetIncludeExpenses;

    /**
     * @var float
     */
    public $fee;

    /**
     * @var string
     */
    public $notes;

    /**
     * @var string
     */
    public $startsOn;

    /**
     * @var string
     */
    public $endsOn;

    /**
     * @var \DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $createdAt;

    /**
     * @var \DateTimeImmutable
     * @PropertyReference(isReference=true, class="\DateTimeImmutable")
     */
    public $updatedAt;
}
