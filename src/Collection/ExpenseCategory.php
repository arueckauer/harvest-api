<?php

namespace arueckauer\HarvestApi\Collection;

use arueckauer\HarvestApi\DataObject\ExpenseCategory as ExpenseCategoryDataObject;

class ExpenseCategory extends AbstractCollection
{
    /**
     * ExpenseCategory constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data, ExpenseCategoryDataObject::class);
    }
}
