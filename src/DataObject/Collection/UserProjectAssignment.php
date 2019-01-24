<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\UserProjectAssignment as UserProjectAssignmentDataObject;

class UserProjectAssignment extends AbstractCollection
{
    /**
     * UserProjectAssignment constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, UserProjectAssignmentDataObject::class);
    }
}
