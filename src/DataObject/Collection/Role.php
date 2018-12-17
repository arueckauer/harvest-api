<?php

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\Role as RoleDataObject;

class Role extends AbstractCollection
{
    /**
     * Role constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, RoleDataObject::class);
    }
}
