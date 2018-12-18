<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\Collection\EstimateItemCategory as EstimateItemCategoryCollection;
use arueckauer\HarvestApi\DataObject\EstimateItemCategory as EstimateItemCategoryDataObject;

class EstimateItemCategories extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'name' => 'name',
    ];

    private static $optionalUpdateFields = [
        'name' => 'name',
    ];

    /**
     * List all estimate item categories
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-item-categories/#list-all-estimate-item-categoriess
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('estimate_item_categories', [\GuzzleHttp\RequestOptions::QUERY => $options]);
        return $this->getCollectionFromResponse(EstimateItemCategoryCollection::class, $response);
    }

    /**
     * Create an estimate item category
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-item-categories/#create-an-estimate-item-category
     * @param EstimateItemCategoryDataObject $estimateItemCategory
     * @return AbstractDataObject
     */
    public function create(EstimateItemCategoryDataObject $estimateItemCategory): AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $estimateItemCategory);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('estimate_item_categories', $options);

        return $this->getDataObjectFromResponse(EstimateItemCategoryDataObject::class, $response);
    }

    /**
     * Retrieve an estimate item category
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-item-categories/#retrieve-an-estimate-item-category
     * @param int $estimateItemCategoryId
     * @return AbstractDataObject
     */
    public function get(int $estimateItemCategoryId): AbstractDataObject
    {
        $uri      = sprintf('estimate_item_categories/%s', $estimateItemCategoryId);
        $response = $this->getHttpClient()->get($uri);
        return $this->getDataObjectFromResponse(EstimateItemCategoryDataObject::class, $response);
    }

    /**
     * Update an estimate item category
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-item-categories/#update-an-estimate-item-category
     * @param EstimateItemCategoryDataObject $estimateItemCategory
     * @return AbstractDataObject
     */
    public function update(EstimateItemCategoryDataObject $estimateItemCategory): AbstractDataObject
    {
        $data     = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, [], $estimateItemCategory);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $uri      = sprintf('estimate_item_categories/%s', $estimateItemCategory->id);
        $response = $this->getHttpClient()->patch($uri, $options);

        return $this->getDataObjectFromResponse(EstimateItemCategoryDataObject::class, $response);
    }

    /**
     * Delete an estimate item category
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-item-categories/#delete-an-estimate-item-category
     * @param int $estimateItemCategoryId
     * @return AbstractDataObject
     */
    public function delete(int $estimateItemCategoryId): AbstractDataObject
    {
        $uri      = sprintf('estimate_item_categories/%s', $estimateItemCategoryId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->getDataObjectFromResponse(EstimateItemCategoryDataObject::class, $response);
    }
}
