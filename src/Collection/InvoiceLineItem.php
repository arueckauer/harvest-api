<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\InvoiceLineItem as InvoiceLineItemModel;

class InvoiceLineItem extends AbstractCollection
{
    /**
     * InvoiceLineItem constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, InvoiceLineItemModel::class);
    }
}
