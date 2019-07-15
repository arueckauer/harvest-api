<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\Collection\ProjectTaskAssignment as ProjectTaskAssignmentCollection;
use arueckauer\HarvestApi\DataObject\ProjectTaskAssignment as ProjectTaskAssignmentDataObject;
use GuzzleHttp\RequestOptions;

class ProjectTaskAssignments extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'task_id' => 'taskId',
    ];

    private static $optionalCreateFields = [
        'is_active'   => 'isActive',
        'billable'    => 'billable',
        'hourly_rate' => 'hourlyRate',
        'budget'      => 'budget',
    ];

    private static $optionalUpdateFields = [
        'is_active'   => 'isActive',
        'billable'    => 'billable',
        'hourly_rate' => 'hourlyRate',
        'budget'      => 'budget',
    ];

    /**
     * List all project task assignments
     * @see https://help.getharvest.com/api-v2/projects-api/projects/task-assignments/#list-all-task-assignments
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []) : AbstractCollection
    {
        $response = $this->getHttpClient()->get('task_assignments', [RequestOptions::QUERY => $options]);
        return $this->getCollectionFromResponse(ProjectTaskAssignmentCollection::class, $response);
    }

    /**
     * List all project task assignments for a specific project
     * @see https://help.getharvest.com/api-v2/projects-api/projects/task-assignments/#list-all-task-assignments-for-a-specific-project
     * @param array $options
     * @param int $projectId
     * @return AbstractCollection
     */
    public function allForProject(int $projectId, array $options = []) : AbstractCollection
    {
        $uri      = sprintf('projects/%s/task_assignments', $projectId);
        $response = $this->getHttpClient()->get($uri, $options);
        return $this->getCollectionFromResponse(ProjectTaskAssignmentCollection::class, $response);
    }

    /**
     * Create a task assignment
     * @see https://help.getharvest.com/api-v2/projects-api/projects/task-assignments/#create-a-task-assignment
     * @param ProjectTaskAssignmentDataObject $projectTaskAssignment
     * @param int $projectId
     * @return AbstractDataObject
     */
    public function create(int $projectId, ProjectTaskAssignmentDataObject $projectTaskAssignment) : AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $projectTaskAssignment);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $projectTaskAssignment);
        $options  = [RequestOptions::JSON => $data];
        $uri      = sprintf('projects/%s/task_assignments', $projectId);
        $response = $this->getHttpClient()->post($uri, $options);

        return $this->getDataObjectFromResponse(ProjectTaskAssignmentDataObject::class, $response);
    }

    /**
     * Retrieve a task assignment
     * @see https://help.getharvest.com/api-v2/projects-api/projects/task-assignments/#retrieve-a-task-assignment
     * @param int $projectTaskAssignmentId
     * @param int $projectId
     * @return AbstractDataObject
     */
    public function get(int $projectId, int $projectTaskAssignmentId) : AbstractDataObject
    {
        $uri      = sprintf('projects/%s/task_assignments/%s', $projectId, $projectTaskAssignmentId);
        $response = $this->getHttpClient()->get($uri);
        return $this->getDataObjectFromResponse(ProjectTaskAssignmentDataObject::class, $response);
    }

    /**
     * Update a task assignment
     * @see https://help.getharvest.com/api-v2/projects-api/projects/task-assignments/#update-a-task-assignment
     * @param ProjectTaskAssignmentDataObject $projectTaskAssignment
     * @param int $projectId
     * @return AbstractDataObject
     */
    public function update(int $projectId, ProjectTaskAssignmentDataObject $projectTaskAssignment) : AbstractDataObject
    {
        $data     = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, [], $projectTaskAssignment);
        $options  = [RequestOptions::JSON => $data];
        $uri      = sprintf('projects/%s/task_assignments/%s', $projectId, $projectTaskAssignment->id);
        $response = $this->getHttpClient()->patch($uri, $options);

        return $this->getDataObjectFromResponse(ProjectTaskAssignmentDataObject::class, $response);
    }

    /**
     * Delete a task assignment
     * @see https://help.getharvest.com/api-v2/projects-api/projects/task-assignments/#delete-a-task-assignment
     * @param int $projectTaskAssignmentId
     * @param int $projectId
     * @return AbstractDataObject
     */
    public function delete(int $projectId, int $projectTaskAssignmentId) : AbstractDataObject
    {
        $uri      = sprintf('projects/%s/task_assignments/%s', $projectId, $projectTaskAssignmentId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->getDataObjectFromResponse(ProjectTaskAssignmentDataObject::class, $response);
    }
}
