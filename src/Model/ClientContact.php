<?php

namespace arueckauer\Harvest\Model;

class ClientContact extends AbstractModel
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
     * @todo DateTime
     */
    public $phoneOffice;

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
