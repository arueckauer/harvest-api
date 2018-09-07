<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\Estimate as EstimateModel;

class Estimate extends AbstractCollection
{
    /**
     * Estimate constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, EstimateModel::class);
    }
}
