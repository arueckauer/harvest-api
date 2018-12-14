<?php

namespace arueckauer\HarvestApi\Model\Property;

use arueckauer\HarvestApi\Model\ModelInterface;
use arueckauer\HarvestApi\PropertyReference;
use Doctrine\Annotations\AnnotationException;
use Doctrine\Annotations\AnnotationReader;

class DataHandler
{
    private $modelClass;

    private $reflectionClass;

    private static $annotationName = PropertyReference::class;

    /**
     * DataHandler constructor.
     * @param string $modelClass
     */
    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
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

        if (null === $propertyConfiguration) {
            return $value;
        }

        if (true === $propertyConfiguration->isReference) {
            return $this->instantiateReferencedClass($propertyConfiguration->class, $value);
        }

        $message = sprintf(
            'Unable to process value due to a mis-configured annotation of property %s in class %s',
            $this->modelClass,
            $reflectionProperty->getName()
        );
        throw new AnnotationException($message);
    }

    private function instantiateReferencedClass(string $class, $data): ModelInterface
    {
        return new $class($data);
    }

    /**
     * Gets ReflectionClass for current model object
     * @throws \ReflectionException
     * @return \ReflectionClass
     */
    private function getReflectionClass(): \ReflectionClass
    {
        if (null === $this->reflectionClass) {
            $this->reflectionClass = new \ReflectionClass($this->modelClass);
        }

        return $this->reflectionClass;
    }

    /**
     * Gets ReflectionProperty object for given property of current model object
     * @param string $property
     * @throws \ReflectionException
     * @return \ReflectionProperty
     */
    private function getReflectionProperty(string $property): \ReflectionProperty
    {
        return $this->getReflectionClass()->getProperty($property);
    }
}
