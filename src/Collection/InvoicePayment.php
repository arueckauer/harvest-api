<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\InvoicePayment as InvoicePaymentModel;

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
