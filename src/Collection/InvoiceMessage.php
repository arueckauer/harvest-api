<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\InvoiceMessage as InvoiceMessageModel;

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
