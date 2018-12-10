<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\Task as TaskModel;

class Task extends AbstractCollection
{
    /**
     * Task constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, TaskModel::class);
    }
}
