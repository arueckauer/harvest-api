<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\DataObject\Estimate as EstimateDataObject;

class Estimate extends AbstractCollection
{
    /**
     * Estimate constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, EstimateDataObject::class);
    }
}
