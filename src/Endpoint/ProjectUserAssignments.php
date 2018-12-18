<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\Collection\ProjectUserAssignment as ProjectUserAssignmentCollection;
use arueckauer\HarvestApi\DataObject\ProjectUserAssignment as ProjectUserAssignmentDataObject;

class ProjectUserAssignments extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'name' => 'name',
    ];

    private static $optionalCreateFields = [
        'billable_by_default' => 'billableByDefault',
        'default_hourly_rate' => 'defaultHourlyRate',
        'is_default'          => 'isDefault',
        'is_active'           => 'isActive',
    ];

    private static $optionalUpdateFields = [
        'name'                => 'name',
        'billable_by_default' => 'billableByDefault',
        'default_hourly_rate' => 'defaultHourlyRate',
        'is_default'          => 'isDefault',
        'is_active'           => 'isActive',
    ];

    /**
     * List all project user assignments
     * @see https://help.getharvest.com/api-v2/projects-api/projects/user-assignments/#list-all-user-assignments
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('user_assignments', [\GuzzleHttp\RequestOptions::QUERY => $options]);
        return $this->getCollectionFromResponse(ProjectUserAssignmentCollection::class, $response);
    }

    /**
     * List all project user assignments for a specific project
     * @see https://help.getharvest.com/api-v2/projects-api/projects/user-assignments/#list-all-user-assignments-for-a-specific-project
     * @param array $options
     * @param int $projectId
     * @return AbstractCollection
     */
    public function allForProject(int $projectId, array $options = []): AbstractCollection
    {
        $uri      = sprintf('projects/%s/user_assignments', $projectId);
        $response = $this->getHttpClient()->get($uri, $options);
        return $this->getCollectionFromResponse(ProjectUserAssignmentCollection::class, $response);
    }

    /**
     * Create a user assignment
     * @see https://help.getharvest.com/api-v2/projects-api/projects/user-assignments/#create-a-user-assignment
     * @param ProjectUserAssignmentDataObject $projectUserAssignment
     * @param int $projectId
     * @return AbstractDataObject
     */
    public function create(int $projectId, ProjectUserAssignmentDataObject $projectUserAssignment): AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $projectUserAssignment);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $projectUserAssignment);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $uri      = sprintf('projects/%s/user_assignments', $projectId);
        $response = $this->getHttpClient()->post($uri, $options);

        return $this->getDataObjectFromResponse(ProjectUserAssignmentDataObject::class, $response);
    }

    /**
     * Retrieve a user assignment
     * @see https://help.getharvest.com/api-v2/projects-api/projects/user-assignments/#retrieve-a-user-assignment
     * @param int $projectUserAssignmentId
     * @param int $projectId
     * @return AbstractDataObject
     */
    public function get(int $projectId, int $projectUserAssignmentId): AbstractDataObject
    {
        $uri      = sprintf('projects/%s/user_assignments/%s', $projectId, $projectUserAssignmentId);
        $response = $this->getHttpClient()->get($uri);
        return $this->getDataObjectFromResponse(ProjectUserAssignmentDataObject::class, $response);
    }

    /**
     * Update a user assignment
     * @see https://help.getharvest.com/api-v2/projects-api/projects/user-assignments/#update-a-user-assignment
     * @param ProjectUserAssignmentDataObject $projectUserAssignment
     * @param int $projectId
     * @return AbstractDataObject
     */
    public function update(int $projectId, ProjectUserAssignmentDataObject $projectUserAssignment): AbstractDataObject
    {
        $data     = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, [], $projectUserAssignment);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $uri      = sprintf('projects/%s/user_assignments/%s', $projectId, $projectUserAssignment->id);
        $response = $this->getHttpClient()->patch($uri, $options);

        return $this->getDataObjectFromResponse(ProjectUserAssignmentDataObject::class, $response);
    }

    /**
     * Delete a user assignment
     * @see https://help.getharvest.com/api-v2/projects-api/projects/user-assignments/#delete-a-user-assignment
     * @param int $projectUserAssignmentId
     * @param int $projectId
     * @return AbstractDataObject
     */
    public function delete(int $projectId, int $projectUserAssignmentId): AbstractDataObject
    {
        $uri      = sprintf('projects/%s/user_assignments/%s', $projectId, $projectUserAssignmentId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->getDataObjectFromResponse(ProjectUserAssignmentDataObject::class, $response);
    }
}
