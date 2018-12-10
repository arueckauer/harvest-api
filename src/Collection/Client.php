<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\Client as ClientModel;

class Client extends AbstractCollection
{
    /**
     * Client constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ClientModel::class);
    }
}
