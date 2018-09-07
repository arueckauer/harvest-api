<?php

namespace arueckauer\Harvest\Model;

class Expense extends AbstractModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var Client
     */
    public $client;

    /**
     * @var Project
     */
    public $project;

    /**
     * @var ExpenseCategory
     */
    public $expenseCategory;

    /**
     * @var User
     */
    public $user;

    /**
     * @var ProjectUserAssignment
     */
    public $userAssignment;

    /**
     * @var object
     * @Todo Define class
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
