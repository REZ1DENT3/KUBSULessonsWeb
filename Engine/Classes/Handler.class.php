<?php

class Handler
{

    public function __construct()
    {

        if (!defined('ACCESS') || !ACCESS) {

            $this->error(403);

        }

    }

    public function setHeader($code)
    {

        header($_SERVER["SERVER_PROTOCOL"] . " $code");

    }

    public function is404($param = null)
    {

        if ($param === false) {

            $this->error();

        }

    }

    public function error(
        $code = 404,
        $setHeader = true,
        $printInformation = true,
        $printCode = true,
        $context = 'Error:'
    )
    {

        $code = trim($code) . ' ';


        switch ($code) {

            case '403 ':
                $error = new Template(Core::get_template() . '403');
                $this->setHeader($code . 'Forbidden');
                $error->display(false);
                break;

            case '404 ':
                $error = new Template(Core::get_template() . '404');
                $this->setHeader($code . 'Not Found');
                $error->display(false);
                break;

        }

        if ($setHeader) {

            $this->setHeader($code);

        }

        if ($printInformation) {

            print "$context ";

            if ($printCode) {

                print  "\"$code\"";

            }

            die;

        }

    }

}