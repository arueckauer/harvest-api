<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Collection\InvoiceItemCategory as InvoiceItemCategoryCollection;
use arueckauer\Harvest\Model\AbstractModel;
use arueckauer\Harvest\Model\InvoiceItemCategory as InvoiceItemCategoryModel;

class InvoiceItemCategories extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'name' => 'name',
    ];

    private static $optionalCreateFields = [
        'billable_by_default' => 'billableByDefault',
        'default_hourly_rate' => 'defaultHourlyRate',
        'is_default'          => 'isDefault',
        'is_active'           => 'isActive',
    ];

    private static $optionalUpdateFields = [
        'name'                => 'name',
        'billable_by_default' => 'billableByDefault',
        'default_hourly_rate' => 'defaultHourlyRate',
        'is_default'          => 'isDefault',
        'is_active'           => 'isActive',
    ];

    /**
     * List all invoice item categories
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-item-categories/#list-all-invoice-item-categories
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('invoice_item_categories', $options);
        return $this->collection(InvoiceItemCategoryCollection::class, $response);
    }

    /**
     * Create an invoice item category
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-item-categories/#create-an-invoice-item-category
     * @param InvoiceItemCategoryModel $invoiceItemCategory
     * @return AbstractModel
     */
    public function create(InvoiceItemCategoryModel $invoiceItemCategory): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $invoiceItemCategory);
        $data     = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $invoiceItemCategory);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('invoice_item_categories', $options);

        return $this->model(InvoiceItemCategoryModel::class, $response);
    }

    /**
     * Retrieve an invoice item category
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-item-categories/#retrieve-an-invoice-item-category
     * @param int $invoiceItemCategoryId
     * @return AbstractModel
     */
    public function get(int $invoiceItemCategoryId): AbstractModel
    {
        $uri      = sprintf('invoice_item_categories/%s', $invoiceItemCategoryId);
        $response = $this->getHttpClient()->get($uri);
        return $this->model(InvoiceItemCategoryModel::class, $response);
    }

    /**
     * Update an invoice item category
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-item-categories/#update-an-invoice-item-category
     * @param InvoiceItemCategoryModel $invoiceItemCategory
     * @return AbstractModel
     */
    public function update(InvoiceItemCategoryModel $invoiceItemCategory): AbstractModel
    {
        $data     = $this->addOptionalDataFromModel(static::$optionalUpdateFields, [], $invoiceItemCategory);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $uri      = sprintf('invoice_item_categories/%s', $invoiceItemCategory->id);
        $response = $this->getHttpClient()->patch($uri, $options);

        return $this->model(InvoiceItemCategoryModel::class, $response);
    }

    /**
     * Delete an invoice item category
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-item-categories/#delete-an-invoice-item-category
     * @param int $invoiceItemCategoryId
     * @return AbstractModel
     */
    public function delete(int $invoiceItemCategoryId): AbstractModel
    {
        $uri      = sprintf('invoice_item_categories/%s', $invoiceItemCategoryId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->model(InvoiceItemCategoryModel::class, $response);
    }
}
