<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\InvoiceLineItem as InvoiceLineItemDataObject;

class InvoiceLineItem extends AbstractCollection
{
    /**
     * InvoiceLineItem constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, InvoiceLineItemDataObject::class);
    }
}
