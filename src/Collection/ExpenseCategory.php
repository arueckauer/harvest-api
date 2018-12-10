<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\Model\ExpenseCategory as ExpenseCategoryModel;

class ExpenseCategory extends AbstractCollection
{
    /**
     * ExpenseCategory constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ExpenseCategoryModel::class);
    }
}
