<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\Role as RoleModel;

class Role extends AbstractCollection
{
    /**
     * Role constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, RoleModel::class);
    }
}
