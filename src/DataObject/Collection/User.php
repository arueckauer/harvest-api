<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\User as UserDataObject;

class User extends AbstractCollection
{
    /**
     * User constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, UserDataObject::class);
    }
}
