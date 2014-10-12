<?php

class Config
{

    private static $Template = 'default';

    public static function __static_construct()
    {

    }

    public static function get()
    {

    }

    public static function set()
    {

    }

    public static function get_template()
    {

        return self::$Template . '/';

    }

}