<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\Collection\Project as ProjectCollection;
use arueckauer\HarvestApi\DataObject\Project as ProjectDataObject;
use GuzzleHttp\RequestOptions;

class Projects extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'client_id'   => 'clientId',
        'name'        => 'name',
        'is_billable' => 'isBillable',
        'bill_by'     => 'billBy',
        'budget_by'   => 'budgetBy',
    ];

    private static $optionalCreateFields = [
        'code'                                => 'code',
        'is_active'                           => 'isActive',
        'is_fixed_fee'                        => 'isFixedFee',
        'hourly_rate'                         => 'hourlyRate',
        'budget'                              => 'budget',
        'budget_is_monthly'                   => 'budgetIsMonthly',
        'notify_when_over_budget'             => 'notifyWhenOverBudget',
        'over_budget_notification_percentage' => 'overBudgetNotificationPercentage',
        'show_budget_to_all'                  => 'showBudgetToAll',
        'cost_budget'                         => 'costBudget',
        'cost_budget_include_expenses'        => 'costBudgetIncludeExpenses',
        'fee'                                 => 'fee',
        'notes'                               => 'notes',
        'starts_on'                           => 'startsOn',
        'ends_on'                             => 'endsOn',
    ];

    private static $optionalUpdateFields = [
        'client_id'                           => 'clientId',
        'name'                                => 'name',
        'code'                                => 'code',
        'is_active'                           => 'isActive',
        'is_billable'                         => 'isBillable',
        'is_fixed_fee'                        => 'isFixedFee',
        'bill_by'                             => 'billBy',
        'hourly_rate'                         => 'hourlyRate',
        'budget'                              => 'budget',
        'budget_by'                           => 'budgetBy',
        'budget_is_monthly'                   => 'budgetIsMonthly',
        'notify_when_over_budget'             => 'notifyWhenOverBudget',
        'over_budget_notification_percentage' => 'overBudgetNotificationPercentage',
        'show_budget_to_all'                  => 'showBudgetToAll',
        'cost_budget'                         => 'costBudget',
        'cost_budget_include_expenses'        => 'costBudgetIncludeExpenses',
        'fee'                                 => 'fee',
        'notes'                               => 'notes',
        'starts_on'                           => 'startsOn',
        'ends_on'                             => 'endsOn',
    ];

    /**
     * List all projects
     * @see https://help.getharvest.com/api-v2/projects-api/projects/projects/#list-all-projects
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []) : AbstractCollection
    {
        $response = $this->getHttpClient()->get('projects', [RequestOptions::QUERY => $options]);
        return $this->getCollectionFromResponse(ProjectCollection::class, $response);
    }

    /**
     * Create a project
     * @see https://help.getharvest.com/api-v2/projects-api/projects/projects/#create-a-project
     * @param ProjectDataObject $project
     * @return AbstractDataObject
     */
    public function create(ProjectDataObject $project) : AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $project);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $project);
        $options  = [RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('projects', $options);

        return $this->getDataObjectFromResponse(ProjectDataObject::class, $response);
    }

    /**
     * Retrieve a project
     * @see https://help.getharvest.com/api-v2/projects-api/projects/projects/#retrieve-a-project
     * @param int $projectId
     * @return AbstractDataObject
     */
    public function get(int $projectId) : AbstractDataObject
    {
        $response = $this->getHttpClient()->get(sprintf('projects/%s', $projectId));
        return $this->getDataObjectFromResponse(ProjectDataObject::class, $response);
    }

    /**
     * Update a project
     * @see https://help.getharvest.com/api-v2/projects-api/projects/projects/#update-a-project
     * @param ProjectDataObject $project
     * @return AbstractDataObject
     */
    public function update(ProjectDataObject $project) : AbstractDataObject
    {
        $data     = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, [], $project);
        $options  = [RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('projects/%s', $project->id), $options);

        return $this->getDataObjectFromResponse(ProjectDataObject::class, $response);
    }

    /**
     * Delete a project
     * @see https://help.getharvest.com/api-v2/projects-api/projects/projects/#delete-a-project
     * @param int $projectId
     * @return AbstractDataObject
     */
    public function delete(int $projectId) : AbstractDataObject
    {
        $response = $this->getHttpClient()->delete(sprintf('projects/%s', $projectId));
        return $this->getDataObjectFromResponse(ProjectDataObject::class, $response);
    }
}
