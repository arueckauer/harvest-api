<?php

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\TimeEntry as TimeEntryDataObject;

class TimeEntry extends AbstractCollection
{
    /**
     * TimeEntry constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, TimeEntryDataObject::class);
    }
}
