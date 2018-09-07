<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\EstimateMessage as EstimateMessageModel;

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
