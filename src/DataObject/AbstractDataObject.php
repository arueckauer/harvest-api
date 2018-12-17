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
     * Convert dataObject to an array
     * @return array
     */
    public function toArray(): array
    {
        $reflection = new \ReflectionObject($this);
        $data       = [];

        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $property = $property->getName();
            $value    = $this->$property;
            if (is_object($value)) {
                if ($value instanceof \DateTimeImmutable) {
                    $value = $value->format(\DateTime::ATOM);
                }
                if ($value instanceof DataObjectInterface) {
                    $value = $value->toArray();
                }
            }

            $data[StringConverter::fromCamelCaseToSnakeCase($property)] = $value;
        }

        return $data;
    }
}
