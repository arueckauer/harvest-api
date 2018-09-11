<?php

namespace arueckauer\Harvest\Model;

use arueckauer\Harvest\Utilities\StringConverter;

abstract class AbstractModel
{
    /**
     * AbstractModel constructor.
     * @param array $data
     * @todo If property is a model, instantiate referenced model class
     * @todo If property is a collection of models, instantiate referenced collection class
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $property = StringConverter::snakeCaseToCamelCase($key);

            if (!property_exists($this, $property)) {
                continue;
            }

            $this->{$property} = $value;
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
