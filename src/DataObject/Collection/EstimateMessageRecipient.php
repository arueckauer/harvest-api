<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

use arueckauer\HarvestApi\DataObject\EstimateMessageRecipient as EstimateMessageRecipientDataObject;

class EstimateMessageRecipient extends AbstractCollection
{
    /**
     * EstimateMessageRecipient constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, EstimateMessageRecipientDataObject::class);
    }
}
