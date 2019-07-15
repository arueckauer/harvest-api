<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\Collection\UserProjectAssignment as UserProjectAssignmentCollection;
use GuzzleHttp\RequestOptions;

class UserProjectAssignments extends AbstractEndpoint
{
    /**
     * List all project assignments
     * @see https://help.getharvest.com/api-v2/users-api/users/project-assignments/#list-all-project-assignments
     * @param array $options
     * @param int $userId
     * @return AbstractCollection
     */
    public function all(int $userId, array $options = []): AbstractCollection
    {
        $uri      = sprintf('users/%s/project_assignments', $userId);
        $response = $this->getHttpClient()->get($uri, [RequestOptions::QUERY => $options]);
        return $this->getCollectionFromResponse(UserProjectAssignmentCollection::class, $response);
    }

    /**
     * List all project assignments for the currently authenticated user
     * @see https://help.getharvest.com/api-v2/users-api/users/project-assignments/#list-all-project-assignments-for-the-currently-authenticated-user
     * @param array $options
     * @return AbstractCollection
     */
    public function allForProject(array $options = []): AbstractCollection
    {
        $uri      = 'users/me/project_assignments';
        $response = $this->getHttpClient()->get($uri, [RequestOptions::QUERY => $options]);
        return $this->getCollectionFromResponse(UserProjectAssignmentCollection::class, $response);
    }
}
