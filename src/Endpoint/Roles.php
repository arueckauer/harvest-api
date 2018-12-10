<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\Collection\AbstractCollection;
use arueckauer\HarvestApi\Collection\Role as RoleCollection;
use arueckauer\HarvestApi\Model\AbstractModel;
use arueckauer\HarvestApi\Model\Role as RoleModel;

class Roles extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'name' => 'name',
    ];

    private static $optionalCreateFields = [
        'user_ids' => 'userIds',
    ];

    private static $requiredUpdateFields = [
        'name' => 'name',
    ];

    private static $optionalUpdateFields = [
        'user_ids' => 'userIds',
    ];

    /**
     * List all roles
     * @see https://help.getharvest.com/api-v2/roles-api/roles/roles/#list-all-roles
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('roles', $options);
        return $this->collection(RoleCollection::class, $response);
    }

    /**
     * Create a role
     * @see https://help.getharvest.com/api-v2/roles-api/roles/roles/#create-a-role
     * @param RoleModel $role
     * @return AbstractModel
     */
    public function create(RoleModel $role): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $role);
        $data     = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $role);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('roles', $options);

        return $this->model(RoleModel::class, $response);
    }

    /**
     * Retrieve a role
     * @see https://help.getharvest.com/api-v2/roles-api/roles/roles/#retrieve-a-role
     * @param int $roleId
     * @return AbstractModel
     */
    public function get(int $roleId): AbstractModel
    {
        $response = $this->getHttpClient()->get(sprintf('roles/%s', $roleId));
        return $this->model(RoleModel::class, $response);
    }

    /**
     * Update a role
     * @see https://help.getharvest.com/api-v2/roles-api/roles/roles/#update-a-role
     * @param RoleModel $role
     * @return AbstractModel
     */
    public function update(RoleModel $role): AbstractModel
    {
        $data     = $this->addOptionalDataFromModel(static::$requiredUpdateFields, [], $role);
        $data     = $this->addOptionalDataFromModel(static::$optionalUpdateFields, $data, $role);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('roles/%s', $role->id), $options);

        return $this->model(RoleModel::class, $response);
    }

    /**
     * Delete a role
     * @see https://help.getharvest.com/api-v2/roles-api/roles/roles/#delete-a-role
     * @param int $roleId
     * @return AbstractModel
     */
    public function delete(int $roleId): AbstractModel
    {
        $response = $this->getHttpClient()->delete(sprintf('roles/%s', $roleId));
        return $this->model(RoleModel::class, $response);
    }
}
