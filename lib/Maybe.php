<?php

namespace Monadist;

class Maybe extends Monad implements \ArrayAccess
{
    private $value;



    public function __construct($value)
    {
        $this->value = $value;
    }



    public function bind(\Closure $lambda)
    {
        return is_null($this->value)
            ? $this
            : $lambda($this->value());
    }



    public function value()
    {
        return $this->value;
    }



    public static function unit($value)
    {
        return new Maybe($value);
    }

    /////////////////
    // ArrayAccess //
    /////////////////

    public function offsetExists($offset)
    {
        return isset($this->value[$offset]);
    }



    public function offsetGet($offset)
    {
        return Maybe::unit(isset($this->value[$offset]) ? $this->value[$offset] : null);
    }



    public function offsetSet($offset, $value)
    {
    }



    public function offsetUnset($offset)
    {
    }
}
