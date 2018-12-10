<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\InvoiceMessage as InvoiceMessageModel;

class InvoiceMessage extends AbstractCollection
{
    /**
     * InvoiceMessage constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, InvoiceMessageModel::class);
    }
}
