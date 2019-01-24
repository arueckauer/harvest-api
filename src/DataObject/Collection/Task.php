<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\Task as TaskDataObject;

class Task extends AbstractCollection
{
    /**
     * Task constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, TaskDataObject::class);
    }
}
