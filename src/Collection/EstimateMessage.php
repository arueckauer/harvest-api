<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\DataObject\EstimateMessage as EstimateMessageDataObject;

class EstimateMessage extends AbstractCollection
{
    /**
     * EstimateMessage constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, EstimateMessageDataObject::class);
    }
}
