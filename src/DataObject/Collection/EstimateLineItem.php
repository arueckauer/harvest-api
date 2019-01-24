<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\EstimateLineItem as EstimateLineItemDataObject;

class EstimateLineItem extends AbstractCollection
{
    /**
     * EstimateLineItem constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, EstimateLineItemDataObject::class);
    }
}
