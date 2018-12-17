<?php

namespace arueckauer\HarvestApi\DataObject\Collection;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;

abstract class AbstractCollection implements ArrayAccess, IteratorAggregate, Countable
{
    private $data = [];

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset] ?? null;
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return \count($this->data);
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }

    /**
     * Convert the collection to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * Set the data for the collection.
     *
     * @param array $data
     * @param string $class
     */
    protected function setData(array $data, $class)
    {
        foreach ($data as $key => $value) {
            $tempData = new $class($value);

            $this->data[$tempData->id] = $tempData;
        }
    }
}
