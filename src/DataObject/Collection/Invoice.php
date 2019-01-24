<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\Invoice as InvoiceDataObject;

class Invoice extends AbstractCollection
{
    /**
     * Invoice constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, InvoiceDataObject::class);
    }
}
