<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\DataObject\ProjectTaskAssignment as ProjectTaskAssignmentDataObject;

class ProjectTaskAssignment extends AbstractCollection
{
    /**
     * ProjectTaskAssignment constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ProjectTaskAssignmentDataObject::class);
    }
}
