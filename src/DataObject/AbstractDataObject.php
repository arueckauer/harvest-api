<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject;

use arueckauer\HarvestApi\DataObject\Property\DataHandler;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Annotations\AnnotationException;
use ReflectionException;
use ReflectionObject;
use ReflectionProperty;
use Zend\Filter\Word\CamelCaseToUnderscore;
use Zend\Filter\Word\UnderscoreToStudlyCase;

abstract class AbstractDataObject implements DataObjectInterface
{
    /**
     * AbstractDataObject constructor.
     * @param array $data
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function __construct(array $data = [])
    {
        $dataHandler = new DataHandler(static::class);
        $wordFilter  = new UnderscoreToStudlyCase();

        foreach ($data as $key => $value) {
            $property = $wordFilter->filter($key);

            if (! property_exists($this, $property)) {
                continue;
            }

            $this->{$property} = $dataHandler->processValue($property, $value);
        }
    }

    /**
     * Convert dataObject to an array
     * @return array
     */
    public function toArray() : array
    {
        $reflection = new ReflectionObject($this);
        $data       = [];
        $wordFiler  = new CamelCaseToUnderscore();

        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $property = $property->getName();
            $value    = $this->$property;
            if (is_object($value)) {
                if ($value instanceof DateTimeImmutable) {
                    $value = $value->format(DateTime::ATOM);
                }
                if ($value instanceof DataObjectInterface) {
                    $value = $value->toArray();
                }
            }

            $key        = $wordFiler->filter($property);
            $data[$key] = $value;
        }

        return $data;
    }
}
