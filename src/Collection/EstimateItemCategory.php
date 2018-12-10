<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\EstimateItemCategory as EstimateItemCategoryModel;

class EstimateItemCategory extends AbstractCollection
{
    /**
     * EstimateItemCategory constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, EstimateItemCategoryModel::class);
    }
}
