<?php

namespace arueckauer\HarvestApi\DataObject\Property;

use arueckauer\HarvestApi\PropertyReference;
use Doctrine\Annotations\AnnotationException;
use Doctrine\Annotations\AnnotationReader;

class DataHandler
{
    private $dataObjectClass;

    private $reflectionClass;

    private static $annotationName = PropertyReference::class;

    /**
     * DataHandler constructor.
     * @param string $dataObjectClass
     */
    public function __construct(string $dataObjectClass)
    {
        $this->dataObjectClass = $dataObjectClass;
        AnnotationReader::addGlobalIgnoredName('todo');
    }

    /**
     * @param string $property
     * @param mixed $value
     * @throws \Doctrine\Annotations\AnnotationException
     * @throws \ReflectionException
     * @return mixed
     */
    public function processValue(string $property, $value)
    {
        $reflectionProperty = $this->getReflectionProperty($property);

        $reader = new AnnotationReader();
        /** @var PropertyReference $propertyConfiguration */
        $propertyConfiguration = $reader->getPropertyAnnotation($reflectionProperty, static::$annotationName);

        // Instantiation of referenced data object requires a data array (not null)
        if (null === $propertyConfiguration || null === $value) {
            return $value;
        }

        if (true === $propertyConfiguration->isReference) {
            return $this->instantiateReferencedClass($propertyConfiguration->class, $value);
        }

        $message = sprintf(
            'Unable to process value due to a mis-configured annotation of property %s in class %s',
            $this->dataObjectClass,
            $reflectionProperty->getName()
        );
        throw new AnnotationException($message);
    }

    private function instantiateReferencedClass(string $class, $data)
    {
        return new $class($data);
    }

    /**
     * Gets ReflectionClass for current dataObject object
     * @throws \ReflectionException
     * @return \ReflectionClass
     */
    private function getReflectionClass(): \ReflectionClass
    {
        if (null === $this->reflectionClass) {
            $this->reflectionClass = new \ReflectionClass($this->dataObjectClass);
        }

        return $this->reflectionClass;
    }

    /**
     * Gets ReflectionProperty object for given property of current dataObject object
     * @param string $property
     * @throws \ReflectionException
     * @return \ReflectionProperty
     */
    private function getReflectionProperty(string $property): \ReflectionProperty
    {
        return $this->getReflectionClass()->getProperty($property);
    }
}
