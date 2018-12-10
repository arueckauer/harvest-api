<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\Invoice as InvoiceModel;

class Invoice extends AbstractCollection
{
    /**
     * Invoice constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, InvoiceModel::class);
    }
}
