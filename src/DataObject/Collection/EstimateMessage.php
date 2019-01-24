<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

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
