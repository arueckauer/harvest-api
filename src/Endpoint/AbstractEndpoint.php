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

    /**
     * Adds values of given required fields to $data array
     * @param array $requiredFields
     * @param array $data
     * @param AbstractModel $model
     * @return array
     */
    protected function addRequiredDataFromModel(array $requiredFields, array $data, AbstractModel $model): array
    {
        foreach ($requiredFields as $key => $property) {
            $data[$key] = $model->$property;
        }

        return $data;
    }

    /**
     * Adds non-null values of given optional fields to $data array
     * @param array $optionalFields
     * @param array $data
     * @param AbstractModel $model
     * @return array
     */
    protected function addOptionalDataFromModel(array $optionalFields, array $data, AbstractModel $model): array
    {
        foreach ($optionalFields as $key => $property) {
            if (null !== $model->$property) {
                $data[$key] = $model->$property;
            }
        }

        return $data;
    }

    /**
     * Gets a value from a model as defined in property argument
     * - For a direct property access, provide property name
     * - For referencing a property of a model property, provide an array with model property in 'class'
     * and property name in 'property'
     * @param AbstractModel $model
     * @param array|string $property
     * @return mixed
     */
    private function getValueFromModel(AbstractModel $model, $property)
    {
        if (\is_string($property)) {
            return $model->$property;
        }

        if (\is_array($property)) {
            return $model->$property['class']->$property['property'];
        }

        throw new \InvalidArgumentException('Property argument must be either of type string or array, neither given.');
    }
}
