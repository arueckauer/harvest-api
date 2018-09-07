<?php

namespace arueckauer\Harvest\Model;

class Client extends AbstractModel
{
    /**
     * @var int
     */
    public $id;

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
    public $address;

    /**
     * @var string
     */
    public $currency;

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
