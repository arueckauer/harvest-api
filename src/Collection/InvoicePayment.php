<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\InvoicePayment as InvoicePaymentModel;

class InvoicePayment extends AbstractCollection
{
    /**
     * InvoicePayment constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, InvoicePaymentModel::class);
    }
}
