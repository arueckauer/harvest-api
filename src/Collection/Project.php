<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\Project as ProjectModel;

class Project extends AbstractCollection
{
    /**
     * Project constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ProjectModel::class);
    }
}
