<?php

namespace Kumatch\Farray;

use ArrayObject;

class Farray extends ArrayObject
{
    public function __construct($input = array(), $flags = 0, $iteratorClass = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iteratorClass);

        foreach ($input as $key => $value) {
            if (is_array($value)) {
                $this->offsetSet($key, new static($value, $flags, $iteratorClass));
            }
        }
    }

    /**
     * @param mixed $index
     * @return mixed|null
     */
    public function offsetGet($index)
    {
        if (parent::offsetExists($index)) {
            return parent::offsetGet($index);
        } else {
            return null;
        }
    }
}