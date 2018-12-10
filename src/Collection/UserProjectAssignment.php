<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\UserProjectAssignment as UserProjectAssignmentModel;

class UserProjectAssignment extends AbstractCollection
{
    /**
     * UserProjectAssignment constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, UserProjectAssignmentModel::class);
    }
}
