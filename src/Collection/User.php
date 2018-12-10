<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\User as UserModel;

class User extends AbstractCollection
{
    /**
     * User constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, UserModel::class);
    }
}
