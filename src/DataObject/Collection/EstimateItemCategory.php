<?php

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\EstimateItemCategory as EstimateItemCategoryDataObject;

class EstimateItemCategory extends AbstractCollection
{
    /**
     * EstimateItemCategory constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, EstimateItemCategoryDataObject::class);
    }
}
