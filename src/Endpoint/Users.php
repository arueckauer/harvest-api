<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Collection\User as UserCollection;
use arueckauer\Harvest\Model\AbstractModel;
use arueckauer\Harvest\Model\User as UserModel;

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
        $response = $this->getHttpClient()->get('users', $options);
        return $this->collection(UserCollection::class, $response);
    }

    /**
     * Create an user
     * @see https://help.getharvest.com/api-v2/users-api/users/users/#create-a-user
     * @param UserModel $user
     * @return AbstractModel
     */
    public function create(UserModel $user): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $user);
        $data     = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $user);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('users', $options);

        return $this->model(UserModel::class, $response);
    }

    /**
     * Retrieve an user
     * @see https://help.getharvest.com/api-v2/users-api/users/users/#retrieve-a-user
     * @param int $userId
     * @return AbstractModel
     */
    public function get(int $userId): AbstractModel
    {
        $response = $this->getHttpClient()->get(sprintf('users/%s', $userId));
        return $this->model(UserModel::class, $response);
    }

    /**
     * Retrieve the currently authenticated user
     * @see https://help.getharvest.com/api-v2/users-api/users/users/#retrieve-the-currently-authenticated-user
     * @return AbstractModel
     */
    public function getCurrentlyAuthenticatedUser(): AbstractModel
    {
        $response = $this->getHttpClient()->get('users/me');
        return $this->model(UserModel::class, $response);
    }

    /**
     * Update an user
     * @see https://help.getharvest.com/api-v2/users-api/users/users/#update-a-user
     * @param UserModel $user
     * @return AbstractModel
     */
    public function update(UserModel $user): AbstractModel
    {
        $data     = $this->addOptionalDataFromModel(static::$optionalUpdateFields, [], $user);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('users/%s', $user->id), $options);

        return $this->model(UserModel::class, $response);
    }

    /**
     * Delete an user
     * @see https://help.getharvest.com/api-v2/users-api/users/users/#delete-a-user
     * @param int $userId
     * @return AbstractModel
     */
    public function delete(int $userId): AbstractModel
    {
        $response = $this->getHttpClient()->delete(sprintf('users/%s', $userId));
        return $this->model(UserModel::class, $response);
    }
}
