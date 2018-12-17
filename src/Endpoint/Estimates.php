<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\Collection\AbstractCollection;
use arueckauer\HarvestApi\Collection\Estimate as EstimateCollection;
use arueckauer\HarvestApi\Collection\EstimateLineItem as LineItemCollection;
use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Estimate as EstimateDataObject;
use arueckauer\HarvestApi\DataObject\EstimateLineItem;

class Estimates extends AbstractEndpoint
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
        'kind'        => 'kind',
        'description' => 'description',
        'quantity'    => 'quantity',
        'unit_price'  => 'unitPrice',
        'taxed'       => 'taxed',
        'taxed2'      => 'taxed2',
    ];

    /**
     * List all estimates
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#list-all-estimates
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('estimates', $options);
        return $this->getCollectionFromResponse(EstimateCollection::class, $response);
    }

    /**
     * Create an estimate
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#create-an-estimate
     * @param EstimateDataObject $estimate
     * @return AbstractDataObject
     */
    public function create(EstimateDataObject $estimate): AbstractDataObject
    {
        $data               = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $estimate);
        $data               = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $estimate);
        $data['line_items'] = $this->generateCreateLineItemsArray($estimate->lineItems);

        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('estimates', $options);

        return $this->getDataObjectFromResponse(EstimateDataObject::class, $response);
    }

    /**
     * Create an estimate line item
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#create-an-estimate-line-item
     * @param int $estimateId
     * @param EstimateLineItem $lineItem
     * @return AbstractDataObject
     */
    public function createLineItem(int $estimateId, EstimateLineItem $lineItem): AbstractDataObject
    {
        $data['line_items'] = $this->generateCreateLineItemArray($lineItem);
        $options            = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response           = $this->getHttpClient()->post(sprintf('estimates/%s', $estimateId), $options);

        return $this->getDataObjectFromResponse(EstimateDataObject::class, $response);
    }

    /**
     * Retrieve an estimate
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#retrieve-an-estimate
     * @param int $estimateId
     * @return AbstractDataObject
     */
    public function get(int $estimateId): AbstractDataObject
    {
        $response = $this->getHttpClient()->get(sprintf('estimates/%s', $estimateId));
        return $this->getDataObjectFromResponse(EstimateDataObject::class, $response);
    }

    /**
     * Update an estimate
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#update-an-estimate
     * @param EstimateDataObject $estimate
     * @return AbstractDataObject
     */
    public function update(EstimateDataObject $estimate): AbstractDataObject
    {
        $data               = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, [], $estimate);
        $data['line_items'] = $this->generateUpdateLineItemsArray($estimate->lineItems);
        $options            = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response           = $this->getHttpClient()->patch(sprintf('estimates/%s', $estimate->id), $options);

        return $this->getDataObjectFromResponse(EstimateDataObject::class, $response);
    }

    /**
     * Update an estimate line item
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#update-an-estimate-line-item
     * @param int $estimateId
     * @param EstimateLineItem $lineItem
     * @return AbstractDataObject
     */
    public function updateLineItem(int $estimateId, EstimateLineItem $lineItem): AbstractDataObject
    {
        $data['line_items'] = $this->generateUpdateLineItemArray($lineItem);
        $options            = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response           = $this->getHttpClient()->post(sprintf('estimates/%s', $estimateId), $options);

        return $this->getDataObjectFromResponse(EstimateDataObject::class, $response);
    }

    /**
     * Delete an estimate
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#delete-an-estimate
     * @param int $estimateId
     * @return AbstractDataObject
     */
    public function delete(int $estimateId): AbstractDataObject
    {
        $uri      = sprintf('estimates/%s', $estimateId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->getDataObjectFromResponse(EstimateDataObject::class, $response);
    }

    /**
     * Delete an estimate line item
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#delete-an-estimate-line-item
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
        $uri      = sprintf('estimates/%s', $lineItemId);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch($uri, $options);
        return $this->getDataObjectFromResponse(EstimateDataObject::class, $response);
    }

    /**
     * Generates array of line items to be created
     * @param LineItemCollection $lineItemCollection
     * @return array
     */
    private function generateCreateLineItemsArray(LineItemCollection $lineItemCollection): array
    {
        $lineItems = [];
        foreach ($lineItemCollection as $lineItemDataObject) {
            $lineItems[] = $this->generateCreateLineItemArray($lineItemDataObject);
        }
        return $lineItems;
    }

    /**
     * Generates line item array
     * @param EstimateLineItem $lineItemDataObject
     * @return array
     */
    private function generateCreateLineItemArray(EstimateLineItem $lineItemDataObject): array
    {
        $requiredFields = static::$requiredLineItemCreateFreeFormFields;
        $optionalFields = static::$optionalLineItemCreateFreeFormFields;
        $data           = $this->addRequiredDataFromDataObject($requiredFields, [], $lineItemDataObject);
        $data           = $this->addOptionalDataFromDataObject($optionalFields, $data, $lineItemDataObject);
        return $data;
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
            $lineItems[] = $this->generateUpdateLineItemArray($lineItemDataObject);
        }
        return $lineItems;
    }

    /**
     * Generates line item array
     * @param EstimateLineItem $lineItemDataObject
     * @return array
     */
    private function generateUpdateLineItemArray(EstimateLineItem $lineItemDataObject): array
    {
        return $this->addOptionalDataFromDataObject(static::$optionalLineItemUpdateFields, [], $lineItemDataObject);
    }
}
