<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\Collection\AbstractCollection;
use arueckauer\HarvestApi\Collection\Task as TaskCollection;
use arueckauer\HarvestApi\Model\AbstractModel;
use arueckauer\HarvestApi\Model\Task as TaskModel;

class Tasks extends AbstractEndpoint
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
     * List all tasks
     * @see https://help.getharvest.com/api-v2/tasks-api/tasks/tasks/#list-all-tasks
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('tasks', $options);
        return $this->collection(TaskCollection::class, $response);
    }

    /**
     * Create a task
     * @see https://help.getharvest.com/api-v2/tasks-api/tasks/tasks/#create-a-task
     * @param TaskModel $task
     * @return AbstractModel
     */
    public function create(TaskModel $task): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $task);
        $data     = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $task);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('tasks', $options);

        return $this->model(TaskModel::class, $response);
    }

    /**
     * Retrieve a task
     * @see https://help.getharvest.com/api-v2/tasks-api/tasks/tasks/#retrieve-a-task
     * @param int $taskId
     * @return AbstractModel
     */
    public function get(int $taskId): AbstractModel
    {
        $response = $this->getHttpClient()->get(sprintf('tasks/%s', $taskId));
        return $this->model(TaskModel::class, $response);
    }

    /**
     * Update a task
     * @see https://help.getharvest.com/api-v2/tasks-api/tasks/tasks/#update-a-task
     * @param TaskModel $task
     * @return AbstractModel
     */
    public function update(TaskModel $task): AbstractModel
    {
        $data     = $this->addOptionalDataFromModel(static::$optionalUpdateFields, [], $task);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('tasks/%s', $task->id), $options);

        return $this->model(TaskModel::class, $response);
    }

    /**
     * Delete a task
     * @see https://help.getharvest.com/api-v2/tasks-api/tasks/tasks/#delete-a-task
     * @param int $taskId
     * @return AbstractModel
     */
    public function delete(int $taskId): AbstractModel
    {
        $response = $this->getHttpClient()->delete(sprintf('tasks/%s', $taskId));
        return $this->model(TaskModel::class, $response);
    }
}
