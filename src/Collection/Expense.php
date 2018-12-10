<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\Expense as ExpenseModel;

class Expense extends AbstractCollection
{
    /**
     * Expense constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ExpenseModel::class);
    }
}
