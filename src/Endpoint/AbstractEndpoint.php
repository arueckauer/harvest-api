<?php

namespace arueckauer\Harvest\Endpoint;

use arueckauer\Harvest\Collection\AbstractCollection;
use arueckauer\Harvest\Model\AbstractModel;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractEndpoint
{
    /**
     * @var ClientInterface|HttpClient
     */
    private $httpClient;

    /**
     * AbstractEndpoint constructor.
     * @param ClientInterface|HttpClient $httpClient
     */
    public function __construct($httpClient)
    {
        $this->setHttpClient($httpClient);
    }

    /**
     * Gets a collection from given response
     * @param string $collectionClass
     * @param ResponseInterface $response
     * @return AbstractCollection
     */
    public function collection(string $collectionClass, ResponseInterface $response): AbstractCollection
    {
        $column = substr($collectionClass, strrpos($collectionClass, '\\') + 1);
        $data   = $this->outerArray($response, strtolower($column));
        return new $collectionClass($data);
    }

    /**
     * Gets a model from given response
     * @param string $modelClass
     * @param ResponseInterface $response
     * @return AbstractModel
     */
    public function model($modelClass, ResponseInterface $response): AbstractModel
    {
        return new $modelClass($this->decodeJson($response));
    }

    /**
     * Gets httpClient
     * @return ClientInterface|HttpClient
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Sets a new httpClient
     * @param ClientInterface|HttpClient $httpClient
     * @return AbstractEndpoint
     */
    public function setHttpClient(ClientInterface $httpClient): AbstractEndpoint
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * Get the outer array. Helper method to retrieve the data we're interested in.
     *
     * @param ResponseInterface $response
     * @param string $column
     * @return mixed
     */
    protected function outerArray(ResponseInterface $response, $column = null)
    {
        $response = $this->decodeJson($response);

        if (null !== $column && array_key_exists($column, $response)) {
            return $response[$column];
        }

        return array_shift($response);
    }

    /**
     * Decode JSON and return the values from a single column in the input array
     * @param ResponseInterface $response
     * @param string $column
     * @return array
     */
    protected function innerArray(ResponseInterface $response, $column): array
    {
        $response = $this->decodeJson($response);
        return array_column($response, $column);
    }

    /**
     * Wrapper for json_decode that throws when an error occurs.
     * @param ResponseInterface $response
     * @return mixed|ResponseInterface
     */
    protected function decodeJson(ResponseInterface $response)
    {
        return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
    }
}
