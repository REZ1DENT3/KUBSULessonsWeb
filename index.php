<?php

define('TPL', 'tpl/');
define('ROOT_DIR', __DIR__ . '/');
define('ENGINE', 'Engine/');
define('ENGINE_CLASSES', ENGINE . 'Classes/');
define('ENGINE_CONTROLLERS', ENGINE . 'Controllers/');
define('ACCESS', true);

include_once ENGINE . 'autoload.php';

$db = new MyPDO(array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
));

$tpl = new Template('main');

Controllers::controller(
    ProcessingRequest::get('controller'),
    ProcessingRequest::get('action')
);

if (ProcessingRequest::get('debug')) {

    var_dump( $Includes );

}

$tpl->display();

//$arr = new ArrayObjectMultidimensional();
//
//for ($i = 1; $i < 10; ++$i) {
//
//    $arr->set($i, new ArrayObject());
//
//    for ($j = 1; $j < 10; ++$j) {
//
//        $arr->set($i, $j, Math::pow(-1, $j + $i) * $i * $j);
//
//    }
//
//    $arr->at($i)->asort();
//
//}