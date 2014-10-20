<?php

class Core
{

    private static $_template = 'default';

    public static function __static_construct()
    {

        $template = Config::get('template');

        if ($template) {

            if (file_exists(ROOT_DIR . TPL . $template)) {

                self::$_template = $template;

            }

        }

    }

    public static function get_template()
    {

        return self::$_template . '/';

    }

}