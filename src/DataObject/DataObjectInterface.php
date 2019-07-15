<?php

declare(strict_types = 1);

namespace arueckauer\HarvestApi\DataObject;

interface DataObjectInterface
{
    public function toArray() : array;
}
