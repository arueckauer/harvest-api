<?php

namespace arueckauer\HarvestApi;

use arueckauer\HarvestApi\Endpoint\ClientContacts;
use arueckauer\HarvestApi\Endpoint\Clients;
use arueckauer\HarvestApi\Endpoint\Company;
use arueckauer\HarvestApi\Endpoint\ExpenseCategories;
use arueckauer\HarvestApi\Endpoint\Projects;
use arueckauer\HarvestApi\Endpoint\Roles;
use arueckauer\HarvestApi\Endpoint\Tasks;
use arueckauer\HarvestApi\Endpoint\TimeEntries;
use arueckauer\HarvestApi\Endpoint\Users;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;

class Client
{
    /**
     * @var ClientInterface|HttpClient
     */
    private $httpClient;

    /**
     * @var ClientContacts
     */
    private $clientContacts;

    /**
     * @var Clients
     */
    private $clients;

    /**
     * @var Company
     */
    private $company;

    /**
     * @var ExpenseCategories
     */
    private $expenseCategories;

    /**
     * @var Roles
     */
    private $roles;

    /**
     * @var Tasks
     */
    private $tasks;

    /**
     * @var TimeEntries
     */
    private $timeEntries;

    /**
     * @var Projects
     */
    private $projects;

    /**
     * @var Users
     */
    private $users;

    /**
     * @var array
     */
    private $headers = [
        'Authorization'      => 'Bearer ',
        'Harvest-Account-Id' => '',
        'User-Agent'         => '',
    ];

    /**
     * @var array
     */
    private $config = [
        'base_uri' => 'https://api.harvestapp.com/v2/',
        'debug'    => false,
    ];

    /**
     * Client constructor.
     * @param array $headers
     * @param array $config
     */
    public function __construct(array $headers = [], array $config = [])
    {
        $this
            ->setHeaders(array_merge($this->getHeaders(), $headers))
            ->setConfig(array_merge($this->getConfig(), $config));
    }

    /**
     * Gets httpClient
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        if (null === $this->httpClient) {
            $config            = $this->getConfig();
            $config['headers'] = $this->getHeaders();

            $this->setHttpClient(new HttpClient($config));
        }

        return $this->httpClient;
    }

    /**
     * Sets a new httpClient
     * @param ClientInterface $httpClient
     * @return Client
     */
    public function setHttpClient(ClientInterface $httpClient): Client
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * Gets client contacts endpoint
     * @return ClientContacts
     */
    public function clientContacts(): ClientContacts
    {
        if (null === $this->clientContacts) {
            $this->clientContacts = new ClientContacts($this->getHttpClient());
        }

        return $this->clientContacts;
    }

    /**
     * Gets clients endpoint
     * @return Clients
     */
    public function clients(): Clients
    {
        if (null === $this->clients) {
            $this->clients = new Clients($this->getHttpClient());
        }

        return $this->clients;
    }

    /**
     * Gets company endpoint
     * @return Company
     */
    public function company(): Company
    {
        if (null === $this->company) {
            $this->company = new Company($this->getHttpClient());
        }

        return $this->company;
    }

    /**
     * Gets expense categories endpoint
     * @return ExpenseCategories
     */
    public function expenseCategories(): ExpenseCategories
    {
        if (null === $this->expenseCategories) {
            $this->expenseCategories = new ExpenseCategories($this->getHttpClient());
        }

        return $this->expenseCategories;
    }

    /**
     * Gets tasks endpoint
     * @return Roles
     */
    public function roles(): Roles
    {
        if (null === $this->roles) {
            $this->roles = new Roles($this->getHttpClient());
        }

        return $this->roles;
    }

    /**
     * Gets tasks endpoint
     * @return Tasks
     */
    public function tasks(): Tasks
    {
        if (null === $this->tasks) {
            $this->tasks = new Tasks($this->getHttpClient());
        }

        return $this->tasks;
    }

    /**
     * Gets time entries endpoint
     * @return TimeEntries
     */
    public function timeEntries(): TimeEntries
    {
        if (null === $this->timeEntries) {
            $this->timeEntries = new TimeEntries($this->getHttpClient());
        }

        return $this->timeEntries;
    }

    /**
     * Gets projects endpoint
     * @return Projects
     */
    public function projects(): Projects
    {
        if (null === $this->projects) {
            $this->projects = new Projects($this->getHttpClient());
        }

        return $this->projects;
    }

    /**
     * Gets users endpoint
     * @return Users
     */
    public function users(): Users
    {
        if (null === $this->users) {
            $this->users = new Users($this->getHttpClient());
        }

        return $this->users;
    }

    /**
     * Gets headers
     * @param string $name
     * @return mixed
     */
    public function getHeaders(string $name = ''): array
    {
        if ('' === $name) {
            return $this->headers;
        }

        if (array_key_exists($name, $this->headers)) {
            return $this->headers[$name];
        }
    }

    /**
     * Adds an entry to headers
     * @param string $name
     * @param $value
     * @return $this
     */
    public function addHeader(string $name, $value): Client
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Sets a new headers
     * @param array $headers
     * @return Client
     */
    public function setHeaders(array $headers): Client
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Gets config
     * @param string $name
     * @return mixed
     */
    public function getConfig(string $name = ''): array
    {
        if ('' === $name) {
            return $this->config;
        }

        if (array_key_exists($name, $this->config)) {
            return $this->config[$name];
        }
    }

    /**
     * Adds an entry to config
     * @param string $name
     * @param $value
     * @return $this
     */
    public function addConfig(string $name, $value): Client
    {
        $this->config[$name] = $value;
        return $this;
    }

    /**
     * Sets a new config
     * @param array $config
     * @return Client
     */
    public function setConfig(array $config): Client
    {
        $this->config = $config;
        return $this;
    }
}
