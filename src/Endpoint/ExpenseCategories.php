<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Collection\ExpenseCategory as ExpenseCategoryCollection;
use arueckauer\Harvest\Model\AbstractModel;
use arueckauer\Harvest\Model\ExpenseCategory as ExpenseCategoryModel;

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
     * @param ExpenseCategoryModel $expenseCategory
     * @return AbstractModel
     */
    public function create(ExpenseCategoryModel $expenseCategory): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $expenseCategory);
        $data     = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $expenseCategory);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('expense_categories', $options);

        return $this->model(ExpenseCategoryModel::class, $response);
    }

    /**
     * Retrieve an expense category
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expense-categories/#retrieve-an-expense-category
     * @param int $expenseCategoryId
     * @return AbstractModel
     */
    public function get($expenseCategoryId): AbstractModel
    {
        $response = $this->getHttpClient()->get(sprintf('expense_categories/%s', $expenseCategoryId));
        return $this->model(ExpenseCategoryModel::class, $response);
    }

    /**
     * Update an expense category
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expense-categories/#update-an-expense-category
     * @param ExpenseCategoryModel $expenseCategory
     * @return AbstractModel
     */
    public function update(ExpenseCategoryModel $expenseCategory): AbstractModel
    {
        $data     = $this->addOptionalDataFromModel(static::$optionalUpdateFields, [], $expenseCategory);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('expense_categories/%s', $expenseCategory->id), $options);

        return $this->model(ExpenseCategoryModel::class, $response);
    }

    /**
     * Delete an expense category
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expense-categories/#delete-an-expense-category
     * @param int $expenseCategoryId
     * @return \arueckauer\Harvest\Model\AbstractModel
     */
    public function delete(int $expenseCategoryId): AbstractModel
    {
        $response = $this->getHttpClient()->delete(sprintf('expense_categories/%s', $expenseCategoryId));
        return $this->model(ExpenseCategoryModel::class, $response);
    }
}
