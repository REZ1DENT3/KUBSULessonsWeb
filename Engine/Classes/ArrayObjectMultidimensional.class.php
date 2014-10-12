<?php

class ArrayObjectMultidimensional
{

    private $Array;

    public function __construct()
    {

        $args = func_get_args();

        if (is_array(current($args))) {

            $args = current($args);

        }

        $this->Array = new ArrayObject($args);

    }

    public function set($i, $v = null)
    {

        $args = func_get_args();

        $p = &$this->Array[array_shift($args)];

        $v = array_pop($args);

        foreach ($args as $arg) {

            $p = &$p[$arg];

        }

        $p = $v;

    }

    public function at()
    {

        $args = func_get_args();

        if (!count($args)) {

            return $this->Array;

        }

        $p = &$this->Array[array_shift($args)];

        foreach ($args as $arg) {

            $p = &$p[$arg];

        }

        return $p;

    }

}