<?php

class Math
{

    private static $_API = false;

    public static $PI = 3.141592;

    public static function __static_construct()
    {

        self::$PI = pi();

    }

    public static function switching_api()
    {

        self::$_API = !self::$_API;

    }

    public static function get_switching_api()
    {

        return self::$_API;

    }

    private static function _getParams($p)
    {

        if ($c = count($p)) {

            if ($c == 1 && is_array(current($p))) {

                return current($p);

            }

            return $p;

        }

        return [];

    }

    public static function pi()
    {

        return self::$PI;

    }

    public static function max()
    {

        return max(self::_getParams(func_get_args()));

    }

    public static function min()
    {

        return min(self::_getParams(func_get_args()));

    }

    public static function sum()
    {

        return array_sum(self::_getParams(func_get_args()));

    }

    public static function swap(&$p1, &$p2)
    {

        list($p1, $p2) = [$p2, $p1];

    }

    public static function multiply()
    {

        $multiply = 1;

        foreach (self::_getParams(func_get_args()) as $p) {

            $multiply *= $p;

        }

        return $multiply;

    }

    public static function sin()
    {

        $args = self::_getParams(func_get_args());

        foreach ($args as &$arg) {

            $arg = sin($arg);

        }

        return $args;

    }

    public static function cos()
    {

        $args = self::_getParams(func_get_args());

        foreach ($args as &$arg) {

            $arg = cos($arg);

        }

        return $args;

    }

    public static function asin()
    {

        $args = self::_getParams(func_get_args());

        foreach ($args as &$arg) {

            $arg = asin($arg);

        }

        return $args;

    }

    public static function acos()
    {

        $args = self::_getParams(func_get_args());

        foreach ($args as &$arg) {

            $arg = acos($arg);

        }

        return $args;

    }

    public static function exp()
    {

        $args = self::_getParams(func_get_args());

        foreach ($args as &$arg) {

            $arg = exp($arg);

        }

        return $args;

    }

    public static function pow($a, $b)
    {

        return pow($a, $b);

    }

}