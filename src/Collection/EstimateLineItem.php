<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\EstimateLineItem as EstimateLineItemModel;

class EstimateLineItem extends AbstractCollection
{
    /**
     * EstimateLineItem constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, EstimateLineItemModel::class);
    }
}
