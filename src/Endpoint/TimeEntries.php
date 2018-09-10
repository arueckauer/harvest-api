<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Collection\TimeEntry as TimeEntryCollection;
use arueckauer\Harvest\Model\AbstractModel;
use arueckauer\Harvest\Model\TimeEntry as TimeEntryModel;

class TimeEntries extends AbstractEndpoint
{
    private static $requiredCreateViaDurationFields = [
        'project_id' => [
            'class'    => 'project',
            'property' => 'id',
        ],
        'task_id' => [
            'class'    => 'task',
            'property' => 'id',
        ],
        'spent_date' => 'spentDate',
    ];

    private static $optionalCreateViaDurationFields = [
        'user_id' => [
            'class'    => 'user',
            'property' => 'id',
        ],
        'hours'              => 'hours',
        'notes'              => 'notes',
        'external_reference' => 'externalReference',
    ];

    private static $requiredCreateViaStartAndEndTimeFields = [
        'project_id' => [
            'class'    => 'project',
            'property' => 'id',
        ],
        'task_id' => [
            'class'    => 'task',
            'property' => 'id',
        ],
        'spent_date' => 'spentDate',
    ];

    private static $optionalCreateViaStartAndEndTimeFields = [
        'user_id' => [
            'class'    => 'user',
            'property' => 'id',
        ],
        'started_time'       => 'startedTime',
        'ended_time'         => 'endedTime',
        'notes'              => 'notes',
        'external_reference' => 'externalReference',
    ];

    private static $optionalUpdateFields = [
        'project_id' => [
            'class'    => 'project',
            'property' => 'id',
        ],
        'task_id' => [
            'class'    => 'task',
            'property' => 'id',
        ],
        'spent_date'         => 'spentDate',
        'started_time'       => 'startedTime',
        'ended_time'         => 'endedTime',
        'hours'              => 'hours',
        'notes'              => 'notes',
        'external_reference' => 'externalReference',
    ];

    /**
     * List all time entries
     * @see https://help.getharvest.com/api-v2/timesheets-api/timesheets/time-entries/#list-all-time-entries
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('time_entries', $options);
        return $this->collection(TimeEntryCollection::class, $response);
    }

    /**
     * Retrieve a time entry
     * @see https://help.getharvest.com/api-v2/timesheets-api/timesheets/time-entries/#retrieve-a-time-entry
     * @param int $timeEntryId
     * @return AbstractModel
     */
    public function get(int $timeEntryId): AbstractModel
    {
        $response = $this->getHttpClient()->get(sprintf('time_entries/%s', $timeEntryId));
        return $this->model(TimeEntryModel::class, $response);
    }

    /**
     * Create a time entry via duration
     * @see https://help.getharvest.com/api-v2/timesheets-api/timesheets/time-entries/#create-a-time-entry-via-duration
     * @todo Depending on company.wants_timestamp_timers, use either duration or start and end time
     * @param TimeEntryModel $timeEntry
     * @return AbstractModel
     */
    public function createViaDuration(TimeEntryModel $timeEntry): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateViaDurationFields, [], $timeEntry);
        $data     = $this->addOptionalDataFromModel(static::$optionalCreateViaDurationFields, $data, $timeEntry);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('time_entries', $options);

        return $this->model(TimeEntryModel::class, $response);
    }

    /**
     * Create a time entry via start and end time
     * @see https://help.getharvest.com/api-v2/timesheets-api/timesheets/time-entries/#create-a-time-entry-via-start-and-end-time
     * @todo Depending on company.wants_timestamp_timers, use either duration or start and end time
     * @param TimeEntryModel $timeEntry
     * @return AbstractModel
     */
    public function createViaStartAndEndTime(TimeEntryModel $timeEntry): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateViaStartAndEndTimeFields, [], $timeEntry);
        $data     = $this->addOptionalDataFromModel(static::$optionalCreateViaStartAndEndTimeFields, $data, $timeEntry);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('time_entries', $options);

        return $this->model(TimeEntryModel::class, $response);
    }

    /**
     * Update a time entry
     * @see https://help.getharvest.com/api-v2/timesheets-api/timesheets/time-entries/#update-a-time-entry
     * @param TimeEntryModel $timeEntry
     * @return AbstractModel
     */
    public function update(TimeEntryModel $timeEntry): AbstractModel
    {
        $data     = $this->addOptionalDataFromModel(static::$optionalUpdateFields, [], $timeEntry);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('time_entries/%s', $timeEntry->id), $options);

        return $this->model(TimeEntryModel::class, $response);
    }

    /**
     * Delete a time entry
     * @see https://help.getharvest.com/api-v2/timesheets-api/timesheets/time-entries/#delete-a-time-entry
     * @param int $timeEntryId
     * @return AbstractModel
     */
    public function delete(int $timeEntryId): AbstractModel
    {
        $response = $this->getHttpClient()->delete(sprintf('time_entries/%s', $timeEntryId));
        return $this->model(TimeEntryModel::class, $response);
    }
}
