<?php

namespace arueckauer\HarvestApi\DataObject;

class ClientContact extends AbstractDataObject
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
     * @var bool
     */
    public $title;

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
     * @todo DateTime
     */
    public $email;

    /**
     * @var string
     */
    public $phoneOffice;

    /**
     * @var string
     */
    public $phoneMobile;

    /**
     * @var
     */
    public $fax;

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
