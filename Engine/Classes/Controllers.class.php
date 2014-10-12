<?php

class Controllers
{

    private static $Controller = 'Page';

    private static $Action = 'index';

    public static function __static_controller()
    {

    }

    public static function get_controller()
    {

        return self::$Controller;

    }

    public static function controller($Controller = null, $name = null)
    {

        if ($Controller) {

            self::$Controller = ucfirst(strtolower($Controller));

        }

        if ($name) {

            self::$Action = ucfirst(strtolower($name));

        }

        if (!class_exists(self::$Controller)) {

            global $handler;
            $handler->error();

        }

        ${self::$Controller} = new self::$Controller();

        if (!method_exists(self::$Controller, 'action_' . self::$Action)) {

            global $handler;
            $handler->error();

        }

        ${self::$Controller}->{'action_' . self::$Action}();

    }

}