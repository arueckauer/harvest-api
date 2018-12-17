<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\DataObject\InvoiceItemCategory as InvoiceItemCategoryDataObject;

class InvoiceItemCategory extends AbstractCollection
{
    /**
     * InvoiceItemCategory constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, InvoiceItemCategoryDataObject::class);
    }
}
