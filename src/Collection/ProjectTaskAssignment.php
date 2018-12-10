<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\ProjectTaskAssignment as ProjectTaskAssignmentModel;

class ProjectTaskAssignment extends AbstractCollection
{
    /**
     * ProjectTaskAssignment constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ProjectTaskAssignmentModel::class);
    }
}
