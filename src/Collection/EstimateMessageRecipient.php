<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\EstimateMessageRecipient as EstimateMessageRecipientModel;

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
