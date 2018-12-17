<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\DataObject\AbstractDataObject;
use arueckauer\HarvestApi\DataObject\Company as CompanyDataObject;

class Company extends AbstractEndpoint
{
    /**
     * Retrieve a company
     * @see https://help.getharvest.com/api-v2/company-api/company/company/#retrieve-a-company
     * @return AbstractDataObject
     */
    public function get(): AbstractDataObject
    {
        $response = $this->getHttpClient()->get('company');
        return $this->getDataObjectFromResponse(CompanyDataObject::class, $response);
    }
}
