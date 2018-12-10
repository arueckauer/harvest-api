<?php

namespace arueckauer\HarvestApi\Model;

class Project extends AbstractModel
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
     * @var Client
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
     * @var string
     * @todo DateTime
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
     * @todo Date
     */
    public $startsOn;

    /**
     * @var string
     * @todo Date
     */
    public $endsOn;

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
