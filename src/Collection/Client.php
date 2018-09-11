<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\Client as ClientModel;

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
