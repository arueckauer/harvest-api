<?php

namespace arueckauer\HarvestApi\Collection;

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
