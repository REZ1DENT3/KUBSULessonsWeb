<?php

class ProcessingRequest
{

    static
    private $env = array(),
        $get = array(),
        $post = array(),
        $files = array(),
        $server = array(),
        $cookie = array(),
        $session = array(),
        $request = array();

    static public function __static_construct()
    {

        session_start();

        self::$env = self::__getValue($_ENV);
        self::$get = self::__getValue($_GET);
        self::$post = self::__getValue($_POST);
        self::$files = self::__getValue($_FILES);
        self::$server = self::__getValue($_SERVER);
        self::$cookie = self::__getValue($_COOKIE);
        self::$session = self::__getValue($_SESSION);
        self::$request = self::__getValue($_REQUEST);

    }

    static private function __getValue($Array)
    {

        return array_map(self::__trim(), $Array);

    }

    static private function __trim()
    {

        return function ($param) {

            if (!empty($param)) {

                return escapeshellcmd(strip_tags(trim($param)));

            }

            return $param;

        };

    }

    static private function _getVariable($param, $key)
    {

        $params = &self::$$param;

        if ($key) {

            if (isset($params[$key])) {

                return $params[$key];

            }

        } else {

            return $params;

        }

        return null;

    }

    static private function _getVariableOrSet($param, $key, $value)
    {

        $params = &self::$$param;

        if ($key) {

            if (isset($params[$key]) && !empty($params[$key])) {

                return $params[$key];

            }

        } else {

            return $params;

        }

        return $params[$key] = $value;

    }

    static public function post($key = null, $trim = true)
    {

        $params = func_get_args();

        $count = count($params);

        if ($trim === false) {

            return $_POST[$key];

        }

        if ($count <= 2) {

            return self::_getVariable('post', $key);

        } else {

            return self::_getVariableOrSet('post', $key, array_pop($params));

        }

    }

    static public function get($key = null, $trim = true)
    {

        $params = func_get_args();

        $count = count($params);

        if ($trim === false) {

            return $_GET[$key];

        }

        if ($count <= 2) {

            return self::_getVariable('get', $key);

        } else {

            return self::_getVariableOrSet('get', $key, array_pop($params));

        }

    }

    static public function files($key = null)
    {

        return self::_getVariable('files', $key);

    }

    static public function server($key = null)
    {

        return self::_getVariable('server', $key);

    }

    static public function cookie($key = null)
    {

        return self::_getVariable('cookie', $key);

    }

    static public function session($key = null)
    {

        return self::_getVariable('session', $key);

    }

    static public function env($key = null)
    {

        return self::_getVariable('env', $key);

    }

    static public function request($key = null)
    {

        return self::_getVariable('request', $key);

    }

}