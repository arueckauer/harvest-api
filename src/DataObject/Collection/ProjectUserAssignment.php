<?php

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\ProjectUserAssignment as ProjectUserAssignmentDataObject;

class ProjectUserAssignment extends AbstractCollection
{
    /**
     * ProjectUserAssignment constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ProjectUserAssignmentDataObject::class);
    }
}
