<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\Task as TaskModel;

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
