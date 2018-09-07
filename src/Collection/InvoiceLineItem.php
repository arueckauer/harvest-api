<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\InvoiceLineItem as InvoiceLineItemModel;

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
