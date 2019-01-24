<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject\Collection;

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
