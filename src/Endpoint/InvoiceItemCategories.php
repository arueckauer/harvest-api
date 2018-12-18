<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\Collection\InvoiceItemCategory as InvoiceItemCategoryCollection;
use arueckauer\HarvestApi\DataObject\InvoiceItemCategory as InvoiceItemCategoryDataObject;

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
        $response = $this->getHttpClient()->get('invoice_item_categories', [\GuzzleHttp\RequestOptions::QUERY => $options]);
        return $this->getCollectionFromResponse(InvoiceItemCategoryCollection::class, $response);
    }

    /**
     * Create an invoice item category
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-item-categories/#create-an-invoice-item-category
     * @param InvoiceItemCategoryDataObject $invoiceItemCategory
     * @return AbstractDataObject
     */
    public function create(InvoiceItemCategoryDataObject $invoiceItemCategory): AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $invoiceItemCategory);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $invoiceItemCategory);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('invoice_item_categories', $options);

        return $this->getDataObjectFromResponse(InvoiceItemCategoryDataObject::class, $response);
    }

    /**
     * Retrieve an invoice item category
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-item-categories/#retrieve-an-invoice-item-category
     * @param int $invoiceItemCategoryId
     * @return AbstractDataObject
     */
    public function get(int $invoiceItemCategoryId): AbstractDataObject
    {
        $uri      = sprintf('invoice_item_categories/%s', $invoiceItemCategoryId);
        $response = $this->getHttpClient()->get($uri);
        return $this->getDataObjectFromResponse(InvoiceItemCategoryDataObject::class, $response);
    }

    /**
     * Update an invoice item category
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-item-categories/#update-an-invoice-item-category
     * @param InvoiceItemCategoryDataObject $invoiceItemCategory
     * @return AbstractDataObject
     */
    public function update(InvoiceItemCategoryDataObject $invoiceItemCategory): AbstractDataObject
    {
        $data     = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, [], $invoiceItemCategory);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $uri      = sprintf('invoice_item_categories/%s', $invoiceItemCategory->id);
        $response = $this->getHttpClient()->patch($uri, $options);

        return $this->getDataObjectFromResponse(InvoiceItemCategoryDataObject::class, $response);
    }

    /**
     * Delete an invoice item category
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoice-item-categories/#delete-an-invoice-item-category
     * @param int $invoiceItemCategoryId
     * @return AbstractDataObject
     */
    public function delete(int $invoiceItemCategoryId): AbstractDataObject
    {
        $uri      = sprintf('invoice_item_categories/%s', $invoiceItemCategoryId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->getDataObjectFromResponse(InvoiceItemCategoryDataObject::class, $response);
    }
}
