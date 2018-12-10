<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\Model\AbstractModel;
use arueckauer\HarvestApi\Model\Company as CompanyModel;

class Company extends AbstractEndpoint
{
    /**
     * Retrieve a company
     * @see https://help.getharvest.com/api-v2/company-api/company/company/#retrieve-a-company
     * @return AbstractModel
     */
    public function get()
    {
        $response = $this->getHttpClient()->get('company');
        return $this->model(CompanyModel::class, $response);
    }
}
