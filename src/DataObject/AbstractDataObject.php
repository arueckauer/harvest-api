<?php

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\DataObject\Property\DataHandler;
use arueckauer\HarvestApi\Utilities\StringConverter;

abstract class AbstractDataObject implements DataObjectInterface
{
    /**
     * AbstractDataObject constructor.
     * @param array $data
     * @throws \Doctrine\Annotations\AnnotationException
     * @throws \ReflectionException
     */
    public function __construct(array $data = [])
    {
        $dataHandler = new DataHandler(static::class);

        foreach ($data as $key => $value) {
            $property = StringConverter::snakeCaseToCamelCase($key);

            if (!property_exists($this, $property)) {
                continue;
            }

            $this->{$property} = $dataHandler->processValue($property, $value);
        }
    }

    /**
     * Convert model to an array
     * @return array
     */
    public function toArray(): array
    {
        $reflection = new \ReflectionObject($this);
        $data       = [];

        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $property = $property->getName();

            $data[StringConverter::fromCamelCaseToSnakeCase($property)] = $this->$property;
        }

        return $data;
    }
}
