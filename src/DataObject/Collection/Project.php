<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\Project as ProjectDataObject;

class Project extends AbstractCollection
{
    /**
     * Project constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ProjectDataObject::class);
    }
}
