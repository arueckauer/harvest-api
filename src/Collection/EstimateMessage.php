<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\EstimateMessage as EstimateMessageModel;

class EstimateMessage extends AbstractCollection
{
    /**
     * EstimateMessage constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, EstimateMessageModel::class);
    }
}
