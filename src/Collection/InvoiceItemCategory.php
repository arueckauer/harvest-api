<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\InvoiceItemCategory as InvoiceItemCategoryModel;

class InvoiceItemCategory extends AbstractCollection
{
    /**
     * InvoiceItemCategory constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, InvoiceItemCategoryModel::class);
    }
}
