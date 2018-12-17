<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\Collection\Role as RoleCollection;
use arueckauer\HarvestApi\DataObject\Role as RoleDataObject;

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
        return $this->getCollectionFromResponse(RoleCollection::class, $response);
    }

    /**
     * Create a role
     * @see https://help.getharvest.com/api-v2/roles-api/roles/roles/#create-a-role
     * @param RoleDataObject $role
     * @return AbstractDataObject
     */
    public function create(RoleDataObject $role): AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $role);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $role);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('roles', $options);

        return $this->getDataObjectFromResponse(RoleDataObject::class, $response);
    }

    /**
     * Retrieve a role
     * @see https://help.getharvest.com/api-v2/roles-api/roles/roles/#retrieve-a-role
     * @param int $roleId
     * @return AbstractDataObject
     */
    public function get(int $roleId): AbstractDataObject
    {
        $response = $this->getHttpClient()->get(sprintf('roles/%s', $roleId));
        return $this->getDataObjectFromResponse(RoleDataObject::class, $response);
    }

    /**
     * Update a role
     * @see https://help.getharvest.com/api-v2/roles-api/roles/roles/#update-a-role
     * @param RoleDataObject $role
     * @return AbstractDataObject
     */
    public function update(RoleDataObject $role): AbstractDataObject
    {
        $data     = $this->addOptionalDataFromDataObject(static::$requiredUpdateFields, [], $role);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, $data, $role);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('roles/%s', $role->id), $options);

        return $this->getDataObjectFromResponse(RoleDataObject::class, $response);
    }

    /**
     * Delete a role
     * @see https://help.getharvest.com/api-v2/roles-api/roles/roles/#delete-a-role
     * @param int $roleId
     * @return AbstractDataObject
     */
    public function delete(int $roleId): AbstractDataObject
    {
        $response = $this->getHttpClient()->delete(sprintf('roles/%s', $roleId));
        return $this->getDataObjectFromResponse(RoleDataObject::class, $response);
    }
}
