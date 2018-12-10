<?php

namespace arueckauer\HarvestApi\Model;

class Company extends AbstractModel
{
    /**
     * @var string
     */
    public $baseUri;

    /**
     * @var string
     */
    public $fullDomain;

    /**
     * @var string
     */
    public $name;

    /**
     * @var bool
     */
    public $isActive;

    /**
     * @var string
     */
    public $weekStartDay;

    /**
     * @var bool
     */
    public $wantsTimestampTimers;

    /**
     * @var string
     */
    public $timeFormat;

    /**
     * @var string
     */
    public $planType;

    /**
     * @var string
     */
    public $clock;

    /**
     * @var string
     */
    public $decimalSymbol;

    /**
     * @var string
     */
    public $thousandsSeparators;

    /**
     * @var string
     */
    public $colorScheme;

    /**
     * @var bool
     */
    public $expenseFeature;

    /**
     * @var bool
     */
    public $invoiceFeature;

    /**
     * @var bool
     */
    public $estimateFeature;

    /**
     * @var bool
     */
    public $approvalFeature;
}
