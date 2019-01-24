<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\ClientContact as ClientContactDataObject;

class ClientContact extends AbstractCollection
{
    /**
     * ClientContact constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ClientContactDataObject::class);
    }
}
