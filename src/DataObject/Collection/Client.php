<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\Client as ClientDataObject;

class Client extends AbstractCollection
{
    /**
     * Client constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ClientDataObject::class);
    }
}
