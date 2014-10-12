<?php

if (!defined('ENGINE_CLASSES')) {

    $dir = explode('/', __DIR__);
    array_pop($dir);

    define('ENGINE_CLASSES', 'Classes/');
    define('ENGINE_CONTROLLERS', 'Controllers/');
    define('ROOT_DIR', implode('/', $dir) . '/');

}

$Includes = array();

function __autoload($class)
{

    global $Includes;

    $types = array(
        'class' => ENGINE_CLASSES,
        'controller' => ENGINE_CONTROLLERS
    );

    foreach ($types as $type => $path) {

        $path .= "{$class}.{$type}.php";

        if (file_exists($path)) {

            include_once $path;

            $Includes[$type][] = $class;

            if (method_exists($class, '__static_construct')) {

                $class::__static_construct();

            }

        }

    }

}

$handler = New Handler();