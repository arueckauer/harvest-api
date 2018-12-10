<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\TimeEntry as TimeEntryModel;

class TimeEntry extends AbstractCollection
{
    /**
     * TimeEntry constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, TimeEntryModel::class);
    }
}
