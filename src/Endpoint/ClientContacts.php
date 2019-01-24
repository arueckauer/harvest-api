<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\ClientContact as ClientContactDataObject;
use arueckauer\HarvestApi\DataObject\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\Collection\ClientContact as ClientContactCollection;

class ClientContacts extends AbstractEndpoint
{
    private static $requiredCreateFields = [
        'client_id'  => 'id',
        'first_name' => 'firstName',
    ];

    private static $optionalCreateFields = [
        'title'        => 'title',
        'last_name'    => 'lastName',
        'email'        => 'email',
        'phone_office' => 'phoneOffice',
        'phone_mobile' => 'phoneMobile',
        'fax'          => 'fax',
    ];

    private static $requiredUpdateFields = [
        'client_id' => 'id',
    ];

    private static $optionalUpdateFields = [
        'title'        => 'title',
        'first_name'   => 'firstName',
        'last_name'    => 'lastName',
        'email'        => 'email',
        'phone_office' => 'phoneOffice',
        'phone_mobile' => 'phoneMobile',
        'fax'          => 'fax',
    ];

    /**
     * List all contacts
     * @see https://help.getharvest.com/api-v2/clients-api/clients/contacts/#list-all-contacts
     * @param array $options
     * @return AbstractCollection
     */
    public function all(array $options = []): AbstractCollection
    {
        $response = $this->getHttpClient()->get('contacts', [\GuzzleHttp\RequestOptions::QUERY => $options]);
        return $this->getCollectionFromResponse(ClientContactCollection::class, $response);
    }

    /**
     * Retrieve a contact
     * @see https://help.getharvest.com/api-v2/clients-api/clients/contacts/#retrieve-a-contact
     * @param int $contactId
     * @return AbstractDataObject
     */
    public function get(int $contactId): AbstractDataObject
    {
        $response = $this->getHttpClient()->get(sprintf('contacts/%s', $contactId));
        return $this->getDataObjectFromResponse(ClientContactDataObject::class, $response);
    }

    /**
     * Create a contact
     * @see https://help.getharvest.com/api-v2/clients-api/clients/contacts/#create-a-contact
     * @param ClientContactDataObject $contact
     * @return AbstractDataObject
     */
    public function create(ClientContactDataObject $contact): AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredCreateFields, [], $contact);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalCreateFields, $data, $contact);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('contacts', $options);

        return $this->getDataObjectFromResponse(ClientContactDataObject::class, $response);
    }

    /**
     * Update a contact
     * @see https://help.getharvest.com/api-v2/clients-api/clients/contacts/#update-a-contact
     * @param ClientContactDataObject $contact
     * @return AbstractDataObject
     */
    public function update(ClientContactDataObject $contact): AbstractDataObject
    {
        $data     = $this->addRequiredDataFromDataObject(static::$requiredUpdateFields, [], $contact);
        $data     = $this->addOptionalDataFromDataObject(static::$optionalUpdateFields, $data, $contact);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('contacts/%s', $contact->id), $options);

        return $this->getDataObjectFromResponse(ClientContactDataObject::class, $response);
    }

    /**
     * Delete a contact
     * @see https://help.getharvest.com/api-v2/clients-api/clients/contacts/#delete-a-contact
     * @param int $contactId
     * @return AbstractDataObject
     */
    public function delete(int $contactId): AbstractDataObject
    {
        $response = $this->getHttpClient()->delete(sprintf('contacts/%s', $contactId));
        return $this->getDataObjectFromResponse(ClientContactDataObject::class, $response);
    }
}
