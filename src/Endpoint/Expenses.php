<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\Collection\AbstractCollection;
use arueckauer\HarvestApi\Collection\Expense as ExpenseCollection;
use arueckauer\HarvestApi\DataObject\Expense as ExpenseDataObject;

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
        return $this->getCollectionFromResponse(ExpenseCollection::class, $response);
    }

    /**
     * Create an expense
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expenses/#create-an-expense
     * @param ExpenseDataObject $expense
     * @return AbstractDataObject
     */
    public function create(ExpenseDataObject $expense): AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $expense);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $expense);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('expenses', $options);

        return $this->getDataObjectFromResponse(ExpenseDataObject::class, $response);
    }

    /**
     * Retrieve an expense
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expenses/#retrieve-an-expense
     * @param int $expenseId
     * @return AbstractDataObject
     */
    public function get(int $expenseId): AbstractDataObject
    {
        $response = $this->getHttpClient()->get(sprintf('expenses/%s', $expenseId));
        return $this->getDataObjectFromResponse(ExpenseDataObject::class, $response);
    }

    /**
     * Update an expense
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expenses/#update-an-expense
     * @param ExpenseDataObject $expense
     * @return AbstractDataObject
     */
    public function update(ExpenseDataObject $expense): AbstractDataObject
    {
        $data     = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, [], $expense);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('expenses/%s', $expense->id), $options);

        return $this->getDataObjectFromResponse(ExpenseDataObject::class, $response);
    }

    /**
     * Delete an expense
     * @see https://help.getharvest.com/api-v2/expenses-api/expenses/expenses/#delete-an-expense
     * @param int $expenseId
     * @return AbstractDataObject
     */
    public function delete(int $expenseId): AbstractDataObject
    {
        $response = $this->getHttpClient()->delete(sprintf('expenses/%s', $expenseId));
        return $this->getDataObjectFromResponse(ExpenseDataObject::class, $response);
    }
}
