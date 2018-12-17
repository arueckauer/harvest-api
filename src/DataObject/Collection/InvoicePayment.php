<?php

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\InvoicePayment as InvoicePaymentDataObject;

class InvoicePayment extends AbstractCollection
{
    /**
     * InvoicePayment constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, InvoicePaymentDataObject::class);
    }
}
