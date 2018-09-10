<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Collection\Expense as ExpenseCollection;
use arueckauer\Harvest\Model\AbstractModel;
use arueckauer\Harvest\Model\Expense as ExpenseModel;

class Expenses extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'project_id'          => 'projectId',
        'expense_category_id' => 'expenseCategoryId',
        'spent_date'          => 'spentDate',
    ];

    private static $optionalCreateFields = [
        'user_id'    => 'userId',
        'units'      => 'units',
        'total_cost' => 'totalCost',
        'notes'      => 'notes',
        'billable'   => 'billable',
        'receipt'    => 'receipt',
    ];

    private static $optionalUpdateFields = [
        'project_id'          => 'projectId',
        'expense_category_id' => 'expenseCategoryId',
        'spent_date'          => 'spentDate',
        'units'               => 'units',
        'total_cost'          => 'totalCost',
        'notes'               => 'notes',
        'billable'            => 'billable',
        'receipt'             => 'receipt',
        'delete_receipt'      => 'deleteReceipt',
    ];

    /**
     * List all expenses
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expenses/#list-all-expenses
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('expenses', $options);
        return $this->collection(ExpenseCollection::class, $response);
    }

    /**
     * Create an expense
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expenses/#create-an-expense
     * @param ExpenseModel $expense
     * @return AbstractModel
     */
    public function create(ExpenseModel $expense): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $expense);
        $data     = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $expense);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('expenses', $options);

        return $this->model(ExpenseModel::class, $response);
    }

    /**
     * Retrieve an expense
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expenses/#retrieve-an-expense
     * @param int $expenseId
     * @return AbstractModel
     */
    public function get($expenseId): AbstractModel
    {
        $response = $this->getHttpClient()->get(sprintf('expenses/%s', $expenseId));
        return $this->model(ExpenseModel::class, $response);
    }

    /**
     * Update an expense
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expenses/#update-an-expense
     * @param ExpenseModel $expense
     * @return AbstractModel
     */
    public function update(ExpenseModel $expense): AbstractModel
    {
        $data     = $this->addOptionalDataFromModel(static::$optionalUpdateFields, [], $expense);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('expenses/%s', $expense->id), $options);

        return $this->model(ExpenseModel::class, $response);
    }

    /**
     * Delete an expense
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expenses/#delete-an-expense
     * @param int $expenseId
     * @return \arueckauer\Harvest\Model\AbstractModel
     */
    public function delete(int $expenseId): AbstractModel
    {
        $response = $this->getHttpClient()->delete(sprintf('expenses/%s', $expenseId));
        return $this->model(ExpenseModel::class, $response);
    }
}
