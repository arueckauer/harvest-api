<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Collection\ClientContact as ClientContactCollection;
use arueckauer\Harvest\Model\AbstractModel;
use arueckauer\Harvest\Model\ClientContact as ClientContactModel;

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
        $response = $this->getHttpClient()->get('contacts', $options);
        return $this->collection(ClientContactCollection::class, $response);
    }

    /**
     * Retrieve a contact
     * @see https://help.getharvest.com/api-v2/clients-api/clients/contacts/#retrieve-a-contact
     * @param int $contactId
     * @return AbstractModel
     */
    public function get(int $contactId): AbstractModel
    {
        $response = $this->getHttpClient()->get(sprintf('contacts/%s', $contactId));
        return $this->model(ClientContactModel::class, $response);
    }

    /**
     * Create a contact
     * @see https://help.getharvest.com/api-v2/clients-api/clients/contacts/#create-a-contact
     * @param ClientContactModel $contact
     * @return AbstractModel
     */
    public function create(ClientContactModel $contact): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredCreateFields, [], $contact);
        $data     = $this->addOptionalDataFromModel(static::$optionalCreateFields, $data, $contact);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->post('contacts', $options);

        return $this->model(ClientContactModel::class, $response);
    }

    /**
     * Update a contact
     * @see https://help.getharvest.com/api-v2/clients-api/clients/contacts/#update-a-contact
     * @param ClientContactModel $contact
     * @return AbstractModel
     */
    public function update(ClientContactModel $contact): AbstractModel
    {
        $data     = $this->addRequiredDataFromModel(static::$requiredUpdateFields, [], $contact);
        $data     = $this->addOptionalDataFromModel(static::$optionalUpdateFields, $data, $contact);
        $options  = [\GuzzleHttp\RequestOptions::JSON => $data];
        $response = $this->getHttpClient()->patch(sprintf('contacts/%s', $contact->id), $options);

        return $this->model(ClientContactModel::class, $response);
    }

    /**
     * Delete a contact
     * @see https://help.getharvest.com/api-v2/clients-api/clients/contacts/#delete-a-contact
     * @param int $contactId
     * @return \arueckauer\Harvest\Model\AbstractModel
     */
    public function delete(int $contactId): AbstractModel
    {
        $response = $this->getHttpClient()->delete(sprintf('contacts/%s', $contactId));
        return $this->model(ClientContactModel::class, $response);
    }
}
