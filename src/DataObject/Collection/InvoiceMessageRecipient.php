<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\InvoiceMessage as InvoiceMessageDataObject;

class InvoiceMessageRecipient extends AbstractCollection
{
    /**
     * InvoiceMessage constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, InvoiceMessageDataObject::class);
    }
}
