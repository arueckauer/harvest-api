<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\Collection\AbstractCollection;
use arueckauer\HarvestApi\Collection\Invoice as InvoiceCollection;
use arueckauer\HarvestApi\Collection\InvoiceLineItem as LineItemCollection;
use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Invoice as InvoiceDataObject;

class Invoices extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'client_id' => 'clientId',
    ];

    private static $optionalCreateFields = [
        'retainer_id'    => 'retainerId',
        'estimate_id'    => 'estimateId',
        'number'         => 'number',
        'purchase_order' => 'purchaseOrder',
        'tax'            => 'tax',
        'tax2'           => 'tax2',
        'discount'       => 'discount',
        'subject'        => 'subject',
        'notes'          => 'notes',
        'currency'       => 'currency',
        'issue_date'     => 'issueDate',
        'due_date'       => 'dueDate',
        'payment_term'   => 'paymentTerm',
        'line_items'     => 'lineItems',
    ];

    private static $requiredLineItemCreateFreeFormFields = [
        'kind'       => 'kind',
        'unit_price' => 'unitPrice',
    ];

    private static $optionalLineItemCreateFreeFormFields = [
        'project_id'  => 'projectId',
        'description' => 'description',
        'quantity'    => 'quantity',
        'taxed'       => 'taxed',
        'taxed2'      => 'taxed2',
    ];

    private static $optionalUpdateFields = [
        'client_id'      => 'clientId',
        'retainer_id'    => 'retainerId',
        'estimate_id'    => 'estimateId',
        'number'         => 'number',
        'purchase_order' => 'purchaseOrder',
        'tax'            => 'tax',
        'tax2'           => 'tax2',
        'discount'       => 'discount',
        'subject'        => 'subject',
        'notes'          => 'notes',
        'currency'       => 'currency',
        'issue_date'     => 'issueDate',
        'due_date'       => 'dueDate',
        'payment_term'   => 'paymentTerm',
        'line_items'     => 'lineItems',
    ];

    private static $optionalLineItemUpdateFields = [
        'id'          => 'id',
        'project_id'  => 'projectId',
        'kind'        => 'kind',
        'description' => 'description',
        'quantity'    => 'quantity',
        'unit_price'  => 'unitPrice',
        'taxed'       => 'taxed',
        'taxed2'      => 'taxed2',
    ];

    /**
     * List all invoices
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoices/#list-all-invoices
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('invoices', $options);
        return $this->collection(InvoiceCollection::class, $response);
    }

    /**
     * Retrieve an invoice
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoices/#retrieve-an-invoice
     * @param int $invoiceId
     * @return AbstractDataObject
     */
    public function get(int $invoiceId): AbstractDataObject
    {
        $response = $this->getHttpClient()->get(sprintf('invoices/%s', $invoiceId));
        return $this->dataObject(InvoiceDataObject::class, $response);
    }

    /**
     * Create a free-form invoice
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoices/#create-a-free-form-invoice
     * @param InvoiceDataObject $invoice
     * @return AbstractDataObject
     */
    public function createFreeForm(InvoiceDataObject $invoice): AbstractDataObject
    {
        $data               = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $invoice);
        $data               = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $invoice);
        $data['line_items'] = $this->generateCreateLineItemsArray($invoice->lineItems);

        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('invoices', $options);

        return $this->dataObject(InvoiceDataObject::class, $response);
    }

    /**
     * Create an invoice based on tracked time and expenses
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoices/#create-an-invoice-based-on-tracked-time-and-expenses
     * @param InvoiceDataObject $invoice
     * @return AbstractDataObject
     */
    public function createBasedOnTrackedTimeAndExpenses(InvoiceDataObject $invoice): AbstractDataObject
    {
        $data               = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $invoice);
        $data               = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $invoice);
        $data['line_items'] = $this->generateCreateLineItemsArray($invoice->lineItems);

        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('invoices', $options);

        return $this->dataObject(InvoiceDataObject::class, $response);
    }

    /**
     * Update a an invoice
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoices/#update-an-invoice
     * @param InvoiceDataObject $invoice
     * @return AbstractDataObject
     */
    public function update(InvoiceDataObject $invoice): AbstractDataObject
    {
        $data               = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, [], $invoice);
        $data['line_items'] = $this->generateUpdateLineItemsArray($invoice->lineItems);
        $options            = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response           = $this->getHttpClient()->patch(sprintf('invoices/%s', $invoice->id), $options);

        return $this->dataObject(InvoiceDataObject::class, $response);
    }

    /**
     * Delete an invoice line item
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoices/#delete-an-invoice-line-item
     * @param int $lineItemId
     * @return AbstractDataObject
     */
    public function deleteLineItem(int $lineItemId): AbstractDataObject
    {
        $data = [
            'line_items' => [
                'id'       => $lineItemId,
                '_destroy' => true,
            ],
        ];
        $uri      = sprintf('invoices/%s', $lineItemId);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch($uri, $options);
        return $this->dataObject(InvoiceDataObject::class, $response);
    }

    /**
     * Delete an invoice
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoices/#delete-an-invoice
     * @param int $invoiceId
     * @return AbstractDataObject
     */
    public function delete(int $invoiceId): AbstractDataObject
    {
        $uri      = sprintf('invoices/%s', $invoiceId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->dataObject(InvoiceDataObject::class, $response);
    }

    /**
     * Generates array of line items to be created
     * @param LineItemCollection $lineItemCollection
     * @return array
     */
    private function generateCreateLineItemsArray(LineItemCollection $lineItemCollection): array
    {
        $requiredFields = static::$requiredLineItemCreateFreeFormFields;
        $optionalFields = static::$optionalLineItemCreateFreeFormFields;
        $lineItems      = [];
        foreach ($lineItemCollection as $lineItemDataObject) {
            $lineItem    = $this->addRequiredDataFromDataObject($requiredFields, [], $lineItemDataObject);
            $lineItem    = $this->addOptionalDataFromDataObject($optionalFields, $lineItem, $lineItemDataObject);
            $lineItems[] = $lineItem;
        }
        return $lineItems;
    }

    /**
     * Generates array of line items to be updated
     * @param LineItemCollection $lineItemCollection
     * @return array
     */
    private function generateUpdateLineItemsArray(LineItemCollection $lineItemCollection): array
    {
        $lineItems = [];
        foreach ($lineItemCollection as $lineItemDataObject) {
            $lineItems[] = $this->addOptionalDataFromDataObject(static::$optionalLineItemUpdateFields, [], $lineItemDataObject);
        }
        return $lineItems;
    }
}
