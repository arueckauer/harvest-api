<?php

namespace arueckauer\HarvestApi\Endpoint;

use arueckauer\HarvestApi\Collection\AbstractCollection;
use arueckauer\HarvestApi\DataObject\AbstractDataObject;
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
    public function getCollectionFromResponse(string $collectionClass, ResponseInterface $response): AbstractCollection
    {
        $column = substr($collectionClass, strrpos($collectionClass, '\\') + 1);
        $data   = $this->outerArray($response, strtolower($column));
        return new $collectionClass($data);
    }

    /**
     * Gets a dataObject from given response
     * @param string $dataObjectClass
     * @param ResponseInterface $response
     * @return AbstractDataObject
     */
    public function getDataObjectFromResponse($dataObjectClass, ResponseInterface $response): AbstractDataObject
    {
        return new $dataObjectClass($this->decodeJson($response));
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

    /**
     * Adds values of given required fields to $data array
     * @param array $requiredFields
     * @param array $data
     * @param AbstractDataObject $dataObject
     * @return array
     * @todo Abstract
     */
    protected function addRequiredDataFromDataObject(
        array $requiredFields,
        array $data,
        AbstractDataObject $dataObject
    ): array {
        foreach ($requiredFields as $key => $property) {
            $data[$key] = $this->getValueFromDataObject($dataObject, $property);
        }

        return $data;
    }

    /**
     * Adds non-null values of given optional fields to $data array
     * @param array $optionalFields
     * @param array $data
     * @param AbstractDataObject $dataObject
     * @return array
     * @todo Abstract
     */
    protected function addOptionalDataFromDataObject(
        array $optionalFields,
        array $data,
        AbstractDataObject $dataObject
    ): array {
        foreach ($optionalFields as $key => $property) {
            if (null !== $dataObject->$property) {
                $data[$key] = $this->getValueFromDataObject($dataObject, $property);
            }
        }

        return $data;
    }

    /**
     * Gets a value from a dataObject as defined in property argument
     * - For a direct property access, provide property name
     * - For referencing a property of a dataObject property, provide an array with dataObject property in 'class'
     * and property name in 'property'
     * @param AbstractDataObject $dataObject
     * @param array|string $property
     * @return mixed
     * @todo Abstract
     */
    private function getValueFromDataObject(AbstractDataObject $dataObject, $property)
    {
        if (\is_string($property)) {
            return $dataObject->$property;
        }

        if (\is_array($property)) {
            return $dataObject->$property['class']->$property['property'];
        }

        throw new \InvalidArgumentException('Property argument must be either of type string or array, neither given.');
    }
}
