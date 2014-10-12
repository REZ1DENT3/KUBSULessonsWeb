<?php

class Hello
{

    public function action_index()
    {

        global $tpl;

        $tpl->assign([

            'title' => __CLASS__,
            'content' => 'Hello World',
            'date_create_page' => date('d-m-Y', time()),
            'date_of_life' => date('Y', time())

        ]);

    }

}