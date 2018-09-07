<?php

namespace arueckauer\Harvest\Collection;

use arueckauer\Harvest\Model\Expense as ExpenseModel;

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
