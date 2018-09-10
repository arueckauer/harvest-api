<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Collection\UserProjectAssignment as UserProjectAssignmentCollection;

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
        $response = $this->getHttpClient()->get($uri, $options);
        return $this->collection(UserProjectAssignmentCollection::class, $response);
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
        $response = $this->getHttpClient()->get($uri, $options);
        return $this->collection(UserProjectAssignmentCollection::class, $response);
    }
}
