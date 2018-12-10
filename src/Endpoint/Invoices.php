<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\Collection\AbstractCollection;
use arueckauer\HarvestApi\Collection\Invoice as InvoiceCollection;
use arueckauer\HarvestApi\Collection\InvoiceLineItem as LineItemCollection;
use arueckauer\HarvestApi\Model\AbstractModel;
use arueckauer\HarvestApi\Model\Invoice as InvoiceModel;

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
     * @return AbstractModel
     */
    public function get(int $invoiceId): AbstractModel
    {
        $response = $this->getHttpClient()->get(sprintf('invoices/%s', $invoiceId));
        return $this->model(InvoiceModel::class, $response);
    }

    /**
     * Create a free-form invoice
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoices/#create-a-free-form-invoice
     * @param InvoiceModel $invoice
     * @return AbstractModel
     */
    public function createFreeForm(InvoiceModel $invoice): AbstractModel
    {
        $data               = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $invoice);
        $data               = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $invoice);
        $data['line_items'] = $this->generateCreateLineItemsArray($invoice->lineItems);

        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('invoices', $options);

        return $this->model(InvoiceModel::class, $response);
    }

    /**
     * Create an invoice based on tracked time and expenses
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoices/#create-an-invoice-based-on-tracked-time-and-expenses
     * @param InvoiceModel $invoice
     * @return AbstractModel
     */
    public function createBasedOnTrackedTimeAndExpenses(InvoiceModel $invoice): AbstractModel
    {
        $data               = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $invoice);
        $data               = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $invoice);
        $data['line_items'] = $this->generateCreateLineItemsArray($invoice->lineItems);

        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('invoices', $options);

        return $this->model(InvoiceModel::class, $response);
    }

    /**
     * Update a an invoice
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoices/#update-an-invoice
     * @param InvoiceModel $invoice
     * @return AbstractModel
     */
    public function update(InvoiceModel $invoice): AbstractModel
    {
        $data               = $this->addOptionalDataFromModel(static::$optionalUpdateFields, [], $invoice);
        $data['line_items'] = $this->generateUpdateLineItemsArray($invoice->lineItems);
        $options            = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response           = $this->getHttpClient()->patch(sprintf('invoices/%s', $invoice->id), $options);

        return $this->model(InvoiceModel::class, $response);
    }

    /**
     * Delete an invoice line item
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoices/#delete-an-invoice-line-item
     * @param int $lineItemId
     * @return AbstractModel
     */
    public function deleteLineItem(int $lineItemId): AbstractModel
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
        return $this->model(InvoiceModel::class, $response);
    }

    /**
     * Delete an invoice
     * @see https://help.getharvest.com/api-v2/invoices-api/invoices/invoices/#delete-an-invoice
     * @param int $invoiceId
     * @return AbstractModel
     */
    public function delete(int $invoiceId): AbstractModel
    {
        $uri      = sprintf('invoices/%s', $invoiceId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->model(InvoiceModel::class, $response);
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
        foreach ($lineItemCollection as $lineItemModel) {
            $lineItem    = $this->addRequiredDataFromModel($requiredFields, [], $lineItemModel);
            $lineItem    = $this->addOptionalDataFromModel($optionalFields, $lineItem, $lineItemModel);
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
        foreach ($lineItemCollection as $lineItemModel) {
            $lineItems[] = $this->addOptionalDataFromModel(static::$optionalLineItemUpdateFields, [], $lineItemModel);
        }
        return $lineItems;
    }
}
