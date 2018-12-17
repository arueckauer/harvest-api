<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\DataObject\Expense as ExpenseDataObject;

class Expense extends AbstractCollection
{
    /**
     * Expense constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ExpenseDataObject::class);
    }
}
