<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\EstimateMessageRecipient as EstimateMessageRecipientModel;

class EstimateMessageRecipient extends AbstractCollection
{
    /**
     * EstimateMessageRecipient constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, EstimateMessageRecipientModel::class);
    }
}
