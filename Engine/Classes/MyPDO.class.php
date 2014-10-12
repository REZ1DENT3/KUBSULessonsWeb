<?php

class MyPDO extends PDO
{

    const PARAM_host = 'localhost';
    const PARAM_port = '3306';
    const PARAM_db_name = 'test1';
    const PARAM_user = 'root';
    const PARAM_db_pass = '';

    public function __construct($options = null)
    {

        parent::__construct(

            'mysql:host=' . MyPDO::PARAM_host .
            ';port=' . MyPDO::PARAM_port .
            ';dbname=' . MyPDO::PARAM_db_name,

            MyPDO::PARAM_user,

            MyPDO::PARAM_db_pass,

            $options

        );

    }

    public function query($query)
    {

        $args = func_get_args();
        array_shift($args);

        $reponse = parent::prepare($query);

        $reponse->execute($args);

        return $reponse;

    }

    public function insecureQuery($query)
    {

        return parent::query($query);

    }

}