<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\Collection\Client as ClientCollection;
use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Client as ClientDataObject;

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
        return $this->getCollectionFromResponse(ClientCollection::class, $response);
    }

    /**
     * Retrieve a client
     * @see https://help.getharvest.com/api-v2/clients-api/clients/clients/#retrieve-a-client
     * @param int $clientId
     * @return AbstractDataObject
     */
    public function get(int $clientId): AbstractDataObject
    {
        $response = $this->getHttpClient()->get(sprintf('clients/%s', $clientId));
        return $this->getDataObjectFromResponse(ClientDataObject::class, $response);
    }

    /**
     * Create a client
     * @see https://help.getharvest.com/api-v2/clients-api/clients/clients/#create-a-client
     * @param ClientDataObject $client
     * @return AbstractDataObject
     */
    public function create(ClientDataObject $client): AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $client);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $client);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('clients', $options);

        return $this->getDataObjectFromResponse(ClientDataObject::class, $response);
    }

    /**
     * Update a client
     * @see https://help.getharvest.com/api-v2/clients-api/clients/clients/#update-a-client
     * @param ClientDataObject $client
     * @return AbstractDataObject
     */
    public function update(ClientDataObject $client): AbstractDataObject
    {
        $data     = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, [], $client);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('clients/%s', $client->id), $options);

        return $this->getDataObjectFromResponse(ClientDataObject::class, $response);
    }

    /**
     * Delete a client
     * @see https://help.getharvest.com/api-v2/clients-api/clients/clients/#delete-a-client
     * @param int $clientId
     * @return AbstractDataObject
     */
    public function delete(int $clientId): AbstractDataObject
    {
        $response = $this->getHttpClient()->delete(sprintf('clients/%s', $clientId));
        return $this->getDataObjectFromResponse(ClientDataObject::class, $response);
    }
}
