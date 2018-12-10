<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\Collection\AbstractCollection;
use arueckauer\HarvestApi\Collection\ProjectTaskAssignment as ProjectTaskAssignmentCollection;
use arueckauer\HarvestApi\Model\AbstractModel;
use arueckauer\HarvestApi\Model\ProjectTaskAssignment as ProjectTaskAssignmentModel;

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
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('task_assignments', $options);
        return $this->collection(ProjectTaskAssignmentCollection::class, $response);
    }

    /**
     * List all project task assignments for a specific project
     * @see https://help.getharvest.com/api-v2/projects-api/projects/task-assignments/#list-all-task-assignments-for-a-specific-project
     * @param array $options
     * @param int $projectId
     * @return AbstractCollection
     */
    public function allForProject(int $projectId, array $options = []): AbstractCollection
    {
        $uri      = sprintf('projects/%s/task_assignments', $projectId);
        $response = $this->getHttpClient()->get($uri, $options);
        return $this->collection(ProjectTaskAssignmentCollection::class, $response);
    }

    /**
     * Create a task assignment
     * @see https://help.getharvest.com/api-v2/projects-api/projects/task-assignments/#create-a-task-assignment
     * @param ProjectTaskAssignmentModel $projectTaskAssignment
     * @param int $projectId
     * @return AbstractModel
     */
    public function create(int $projectId, ProjectTaskAssignmentModel $projectTaskAssignment): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $projectTaskAssignment);
        $data     = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $projectTaskAssignment);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $uri      = sprintf('projects/%s/task_assignments', $projectId);
        $response = $this->getHttpClient()->post($uri, $options);

        return $this->model(ProjectTaskAssignmentModel::class, $response);
    }

    /**
     * Retrieve a task assignment
     * @see https://help.getharvest.com/api-v2/projects-api/projects/task-assignments/#retrieve-a-task-assignment
     * @param int $projectTaskAssignmentId
     * @param int $projectId
     * @return AbstractModel
     */
    public function get(int $projectId, int $projectTaskAssignmentId): AbstractModel
    {
        $uri      = sprintf('projects/%s/task_assignments/%s', $projectId, $projectTaskAssignmentId);
        $response = $this->getHttpClient()->get($uri);
        return $this->model(ProjectTaskAssignmentModel::class, $response);
    }

    /**
     * Update a task assignment
     * @see https://help.getharvest.com/api-v2/projects-api/projects/task-assignments/#update-a-task-assignment
     * @param ProjectTaskAssignmentModel $projectTaskAssignment
     * @param int $projectId
     * @return AbstractModel
     */
    public function update(int $projectId, ProjectTaskAssignmentModel $projectTaskAssignment): AbstractModel
    {
        $data     = $this->addOptionalDataFromModel(static::$optionalUpdateFields, [], $projectTaskAssignment);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $uri      = sprintf('projects/%s/task_assignments/%s', $projectId, $projectTaskAssignment->id);
        $response = $this->getHttpClient()->patch($uri, $options);

        return $this->model(ProjectTaskAssignmentModel::class, $response);
    }

    /**
     * Delete a task assignment
     * @see https://help.getharvest.com/api-v2/projects-api/projects/task-assignments/#delete-a-task-assignment
     * @param int $projectTaskAssignmentId
     * @param int $projectId
     * @return AbstractModel
     */
    public function delete(int $projectId, int $projectTaskAssignmentId): AbstractModel
    {
        $uri      = sprintf('projects/%s/task_assignments/%s', $projectId, $projectTaskAssignmentId);
        $response = $this->getHttpClient()->delete($uri);
        return $this->model(ProjectTaskAssignmentModel::class, $response);
    }
}
