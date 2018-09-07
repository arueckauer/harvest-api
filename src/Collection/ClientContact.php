<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\ClientContact as ClientContactModel;

class ClientContact extends AbstractCollection
{
    /**
     * ClientContact constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ClientContactModel::class);
    }
}