<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\Collection\User as UserCollection;
use arueckauer\HarvestApi\DataObject\User as UserDataObject;
use GuzzleHttp\RequestOptions;

class Users extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'first_name' => 'firstName',
        'last_name'  => 'lastName',
        'email'      => 'email',
    ];

    private static $optionalCreateFields = [
        'telephone'                         => 'telephone',
        'timezone'                          => 'timezone',
        'has_access_to_all_future_projects' => 'hasAccessToAllFutureProjects',
        'is_contractor'                     => 'isContractor',
        'is_admin'                          => 'isAdmin',
        'is_project_manager'                => 'isProjectManager',
        'can_see_rates'                     => 'canSeeRates',
        'can_create_projects'               => 'canCreateProjects',
        'can_create_invoices'               => 'canCreateInvoices',
        'is_active'                         => 'isActive',
        'weekly_capacity'                   => 'weeklyCapacity',
        'default_hourly_rate'               => 'defaultHourlyRate',
        'cost_rate'                         => 'costRate',
        'roles'                             => 'roles',
    ];

    private static $optionalUpdateFields = [
        'first_name'                        => 'firstName',
        'last_name'                         => 'lastName',
        'email'                             => 'email',
        'telephone'                         => 'telephone',
        'timezone'                          => 'timezone',
        'has_access_to_all_future_projects' => 'hasAccessToAllFutureProjects',
        'is_contractor'                     => 'isContractor',
        'is_admin'                          => 'isAdmin',
        'is_project_manager'                => 'isProjectManager',
        'can_see_rates'                     => 'canSeeRates',
        'can_create_projects'               => 'canCreateProjects',
        'can_create_invoices'               => 'canCreateInvoices',
        'is_active'                         => 'isActive',
        'weekly_capacity'                   => 'weeklyCapacity',
        'default_hourly_rate'               => 'defaultHourlyRate',
        'cost_rate'                         => 'costRate',
        'roles'                             => 'roles',
    ];

    /**
     * List all users
     * @see https://help.getharvest.com/api-v2/users-api/users/users/#list-all-users
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('users', [RequestOptions::QUERY => $options]);
        return $this->getCollectionFromResponse(UserCollection::class, $response);
    }

    /**
     * Create an user
     * @see https://help.getharvest.com/api-v2/users-api/users/users/#create-a-user
     * @param UserDataObject $user
     * @return AbstractDataObject
     */
    public function create(UserDataObject $user): AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $user);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $user);
        $options  = [RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('users', $options);

        return $this->getDataObjectFromResponse(UserDataObject::class, $response);
    }

    /**
     * Retrieve an user
     * @see https://help.getharvest.com/api-v2/users-api/users/users/#retrieve-a-user
     * @param int $userId
     * @return AbstractDataObject
     */
    public function get(int $userId): AbstractDataObject
    {
        $response = $this->getHttpClient()->get(sprintf('users/%s', $userId));
        return $this->getDataObjectFromResponse(UserDataObject::class, $response);
    }

    /**
     * Retrieve the currently authenticated user
     * @see https://help.getharvest.com/api-v2/users-api/users/users/#retrieve-the-currently-authenticated-user
     * @return AbstractDataObject
     */
    public function getCurrentlyAuthenticatedUser(): AbstractDataObject
    {
        $response = $this->getHttpClient()->get('users/me');
        return $this->getDataObjectFromResponse(UserDataObject::class, $response);
    }

    /**
     * Update an user
     * @see https://help.getharvest.com/api-v2/users-api/users/users/#update-a-user
     * @param UserDataObject $user
     * @return AbstractDataObject
     */
    public function update(UserDataObject $user): AbstractDataObject
    {
        $data     = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, [], $user);
        $options  = [RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('users/%s', $user->id), $options);

        return $this->getDataObjectFromResponse(UserDataObject::class, $response);
    }

    /**
     * Delete an user
     * @see https://help.getharvest.com/api-v2/users-api/users/users/#delete-a-user
     * @param int $userId
     * @return AbstractDataObject
     */
    public function delete(int $userId): AbstractDataObject
    {
        $response = $this->getHttpClient()->delete(sprintf('users/%s', $userId));
        return $this->getDataObjectFromResponse(UserDataObject::class, $response);
    }
}
