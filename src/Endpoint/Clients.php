<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Collection\Client as ClientCollection;
use arueckauer\Harvest\Model\AbstractModel;
use arueckauer\Harvest\Model\Client as ClientModel;

class Clients extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'name' => 'name',
    ];

    private static $optionalCreateFields = [
        'is_active' => 'isActive',
        'address'   => 'address',
        'currency'  => 'currency',
    ];

    private static $optionalUpdateFields = [
        'name'      => 'name',
        'is_active' => 'isActive',
        'address'   => 'address',
        'currency'  => 'currency',
    ];

    /**
     * List all clients
     * @see https://help.getharvest.com/api-v2/clients-api/clients/clients/#list-all-clients
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('clients', $options);
        return $this->collection(ClientCollection::class, $response);
    }

    /**
     * Retrieve a client
     * @see https://help.getharvest.com/api-v2/clients-api/clients/clients/#retrieve-a-client
     * @param int $clientId
     * @return AbstractModel
     */
    public function get(int $clientId): AbstractModel
    {
        $response = $this->getHttpClient()->get(sprintf('clients/%s', $clientId));
        return $this->model(ClientModel::class, $response);
    }

    /**
     * Create a client
     * @see https://help.getharvest.com/api-v2/clients-api/clients/clients/#create-a-client
     * @param ClientModel $client
     * @return AbstractModel
     */
    public function create(ClientModel $client): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $client);
        $data     = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $client);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('clients', $options);

        return $this->model(ClientModel::class, $response);
    }

    /**
     * Update a client
     * @see https://help.getharvest.com/api-v2/clients-api/clients/clients/#update-a-client
     * @param ClientModel $client
     * @return AbstractModel
     */
    public function update(ClientModel $client): AbstractModel
    {
        $data     = $this->addOptionalDataFromModel(static::$optionalUpdateFields, [], $client);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('clients/%s', $client->id), $options);

        return $this->model(ClientModel::class, $response);
    }

    /**
     * Delete a client
     * @see https://help.getharvest.com/api-v2/clients-api/clients/clients/#delete-a-client
     * @param int $clientId
     * @return AbstractModel
     */
    public function delete(int $clientId): AbstractModel
    {
        $response = $this->getHttpClient()->delete(sprintf('clients/%s', $clientId));
        return $this->model(ClientModel::class, $response);
    }
}
