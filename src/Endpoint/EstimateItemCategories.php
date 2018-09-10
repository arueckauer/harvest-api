<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Collection\EstimateItemCategory as EstimateItemCategoryCollection;
use arueckauer\Harvest\Model\AbstractModel;
use arueckauer\Harvest\Model\EstimateItemCategory as EstimateItemCategoryModel;

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
        $response = $this->getHttpClient()->get('estimate_item_categories', $options);
        return $this->collection(EstimateItemCategoryCollection::class, $response);
    }

    /**
     * Create an estimate item category
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-item-categories/#create-an-estimate-item-category
     * @param EstimateItemCategoryModel $estimateItemCategory
     * @return AbstractModel
     */
    public function create(EstimateItemCategoryModel $estimateItemCategory): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $estimateItemCategory);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('estimate_item_categories', $options);

        return $this->model(EstimateItemCategoryModel::class, $response);
    }

    /**
     * Retrieve an estimate item category
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-item-categories/#retrieve-an-estimate-item-category
     * @param int $estimateItemCategoryId
     * @return AbstractModel
     */
    public function get(int $estimateItemCategoryId): AbstractModel
    {
        $uri      = sprintf('estimate_item_categories/%s', $estimateItemCategoryId);
        $response = $this->getHttpClient()->get($uri);
        return $this->model(EstimateItemCategoryModel::class, $response);
    }

    /**
     * Update an estimate item category
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-item-categories/#update-an-estimate-item-category
     * @param EstimateItemCategoryModel $estimateItemCategory
     * @return AbstractModel
     */
    public function update(EstimateItemCategoryModel $estimateItemCategory): AbstractModel
    {
        $data     = $this->addOptionalDataFromModel(static::$optionalUpdateFields, [], $estimateItemCategory);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $uri      = sprintf('estimate_item_categories/%s', $estimateItemCategory->id);
        $response = $this->getHttpClient()->patch($uri, $options);

        return $this->model(EstimateItemCategoryModel::class, $response);
    }

    /**
     * Delete an estimate item category
     * @see https://help.getharvest.com/api-v2/estimates-api/estimates/estimate-item-categories/#delete-an-estimate-item-category
     * @param int $estimateItemCategoryId
     * @return \arueckauer\Harvest\Model\AbstractModel
     */
    public function delete(int $estimateItemCategoryId): AbstractModel
    {
        $uri      = sprintf('estimate_item_categories/%s', $estimateItemCategoryId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->model(EstimateItemCategoryModel::class, $response);
    }
}
