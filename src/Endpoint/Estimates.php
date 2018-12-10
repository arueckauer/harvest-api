<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\Collection\AbstractCollection;
use arueckauer\HarvestApi\Collection\Estimate as EstimateCollection;
use arueckauer\HarvestApi\Collection\EstimateLineItem as LineItemCollection;
use arueckauer\HarvestApi\Model\AbstractModel;
use arueckauer\HarvestApi\Model\Estimate as EstimateModel;
use arueckauer\HarvestApi\Model\EstimateLineItem;

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
        return $this->collection(EstimateCollection::class, $response);
    }

    /**
     * Create an estimate
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#create-an-estimate
     * @param EstimateModel $estimate
     * @return AbstractModel
     */
    public function create(EstimateModel $estimate): AbstractModel
    {
        $data               = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $estimate);
        $data               = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $estimate);
        $data['line_items'] = $this->generateCreateLineItemsArray($estimate->lineItems);

        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('estimates', $options);

        return $this->model(EstimateModel::class, $response);
    }

    /**
     * Create an estimate line item
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#create-an-estimate-line-item
     * @param int $estimateId
     * @param EstimateLineItem $lineItem
     * @return AbstractModel
     */
    public function createLineItem(int $estimateId, EstimateLineItem $lineItem): AbstractModel
    {
        $data['line_items'] = $this->generateCreateLineItemArray($lineItem);
        $options            = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response           = $this->getHttpClient()->post(sprintf('estimates/%s', $estimateId), $options);

        return $this->model(EstimateModel::class, $response);
    }

    /**
     * Retrieve an estimate
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#retrieve-an-estimate
     * @param int $estimateId
     * @return AbstractModel
     */
    public function get(int $estimateId): AbstractModel
    {
        $response = $this->getHttpClient()->get(sprintf('estimates/%s', $estimateId));
        return $this->model(EstimateModel::class, $response);
    }

    /**
     * Update an estimate
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#update-an-estimate
     * @param EstimateModel $estimate
     * @return AbstractModel
     */
    public function update(EstimateModel $estimate): AbstractModel
    {
        $data               = $this->addOptionalDataFromModel(static::$optionalUpdateFields, [], $estimate);
        $data['line_items'] = $this->generateUpdateLineItemsArray($estimate->lineItems);
        $options            = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response           = $this->getHttpClient()->patch(sprintf('estimates/%s', $estimate->id), $options);

        return $this->model(EstimateModel::class, $response);
    }

    /**
     * Update an estimate line item
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#update-an-estimate-line-item
     * @param int $estimateId
     * @param EstimateLineItem $lineItem
     * @return AbstractModel
     */
    public function updateLineItem(int $estimateId, EstimateLineItem $lineItem): AbstractModel
    {
        $data['line_items'] = $this->generateUpdateLineItemArray($lineItem);
        $options            = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response           = $this->getHttpClient()->post(sprintf('estimates/%s', $estimateId), $options);

        return $this->model(EstimateModel::class, $response);
    }

    /**
     * Delete an estimate
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#delete-an-estimate
     * @param int $estimateId
     * @return AbstractModel
     */
    public function delete(int $estimateId): AbstractModel
    {
        $uri      = sprintf('estimates/%s', $estimateId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->model(EstimateModel::class, $response);
    }

    /**
     * Delete an estimate line item
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimates/#delete-an-estimate-line-item
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
        $uri      = sprintf('estimates/%s', $lineItemId);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch($uri, $options);
        return $this->model(EstimateModel::class, $response);
    }

    /**
     * Generates array of line items to be created
     * @param LineItemCollection $lineItemCollection
     * @return array
     */
    private function generateCreateLineItemsArray(LineItemCollection $lineItemCollection): array
    {
        $lineItems = [];
        foreach ($lineItemCollection as $lineItemModel) {
            $lineItems[] = $this->generateCreateLineItemArray($lineItemModel);
        }
        return $lineItems;
    }

    /**
     * Generates line item array
     * @param EstimateLineItem $lineItemModel
     * @return array
     */
    private function generateCreateLineItemArray(EstimateLineItem $lineItemModel): array
    {
        $requiredFields = static::$requiredLineItemCreateFreeFormFields;
        $optionalFields = static::$optionalLineItemCreateFreeFormFields;
        $data           = $this->addRequiredDataFromModel($requiredFields, [], $lineItemModel);
        $data           = $this->addOptionalDataFromModel($optionalFields, $data, $lineItemModel);
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
        foreach ($lineItemCollection as $lineItemModel) {
            $lineItems[] = $this->generateUpdateLineItemArray($lineItemModel);
        }
        return $lineItems;
    }

    /**
     * Generates line item array
     * @param EstimateLineItem $lineItemModel
     * @return array
     */
    private function generateUpdateLineItemArray(EstimateLineItem $lineItemModel): array
    {
        return $this->addOptionalDataFromModel(static::$optionalLineItemUpdateFields, [], $lineItemModel);
    }
}
