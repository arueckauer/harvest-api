<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\ProjectTaskAssignment as ProjectTaskAssignmentModel;

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
