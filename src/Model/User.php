<?php

namespace arueckauer\Harvest\Model;

class User extends AbstractModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $telephone;

    /**
     * @var string
     */
    public $timezone;

    /**
     * @var bool
     */
    public $hasAccessToAllFutureProjects;

    /**
     * @var bool
     */
    public $isContractor;

    /**
     * @var bool
     */
    public $isAdmin;

    /**
     * @var bool
     */
    public $isProjectManager;

    /**
     * @var bool
     */
    public $canSeeRates;

    /**
     * @var bool
     */
    public $canCreateProjects;

    /**
     * @var bool
     */
    public $canCreateInvoices;

    /**
     * @var bool
     */
    public $isActive;

    /**
     * @var int
     */
    public $weeklyCapacity;

    /**
     * @var float
     */
    public $defaultHourlyRate;

    /**
     * @var float
     */
    public $costRate;

    /**
     * @var array
     */
    public $roles;

    /**
     * @var string
     */
    public $avatarUrl;

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