<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\Invoice as InvoiceModel;

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
