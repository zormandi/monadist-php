<?php

namespace Monadist;

class Monad
{
    public function fmap($lambda)
    {
        return $this->bind(function ($value) use ($lambda) {
            return Maybe::unit($lambda($value));
        });
    }



    function __call($name, $arguments)
    {
        return $this->fmap(function ($value) use ($name, $arguments) {
            return call_user_func_array(array($value, $name), $arguments);
        });
    }
}
