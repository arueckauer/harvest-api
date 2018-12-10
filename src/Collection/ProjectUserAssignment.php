<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\ProjectUserAssignment as ProjectUserAssignmentModel;

class ProjectUserAssignment extends AbstractCollection
{
    /**
     * ProjectUserAssignment constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ProjectUserAssignmentModel::class);
    }
}
