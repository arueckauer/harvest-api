<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\InvoiceItemCategory as InvoiceItemCategoryModel;

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
