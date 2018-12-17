<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\Collection\AbstractCollection;
use arueckauer\HarvestApi\Collection\ExpenseCategory as ExpenseCategoryCollection;
use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\ExpenseCategory as ExpenseCategoryDataObject;

class ExpenseCategories extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'name' => 'name',
    ];

    private static $optionalCreateFields = [
        'unit_name'  => 'unitName',
        'unit_price' => 'unitPrice',
        'is_active'  => 'isActive',
    ];

    private static $optionalUpdateFields = [
        'name'       => 'name',
        'unit_name'  => 'unitName',
        'unit_price' => 'unitPrice',
        'is_active'  => 'isActive',
    ];

    /**
     * List all expense categories
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expense-categories/#list-all-expense-categories
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('expense_categories', $options);
        return $this->collection(ExpenseCategoryCollection::class, $response);
    }

    /**
     * Create an expense category
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expense-categories/#create-an-expense-category
     * @param ExpenseCategoryDataObject $expenseCategory
     * @return AbstractDataObject
     */
    public function create(ExpenseCategoryDataObject $expenseCategory): AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $expenseCategory);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $expenseCategory);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('expense_categories', $options);

        return $this->dataObject(ExpenseCategoryDataObject::class, $response);
    }

    /**
     * Retrieve an expense category
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expense-categories/#retrieve-an-expense-category
     * @param int $expenseCategoryId
     * @return AbstractDataObject
     */
    public function get(int $expenseCategoryId): AbstractDataObject
    {
        $response = $this->getHttpClient()->get(sprintf('expense_categories/%s', $expenseCategoryId));
        return $this->dataObject(ExpenseCategoryDataObject::class, $response);
    }

    /**
     * Update an expense category
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expense-categories/#update-an-expense-category
     * @param ExpenseCategoryDataObject $expenseCategory
     * @return AbstractDataObject
     */
    public function update(ExpenseCategoryDataObject $expenseCategory): AbstractDataObject
    {
        $data     = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, [], $expenseCategory);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('expense_categories/%s', $expenseCategory->id), $options);

        return $this->dataObject(ExpenseCategoryDataObject::class, $response);
    }

    /**
     * Delete an expense category
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expense-categories/#delete-an-expense-category
     * @param int $expenseCategoryId
     * @return AbstractDataObject
     */
    public function delete(int $expenseCategoryId): AbstractDataObject
    {
        $response = $this->getHttpClient()->delete(sprintf('expense_categories/%s', $expenseCategoryId));
        return $this->dataObject(ExpenseCategoryDataObject::class, $response);
    }
}
