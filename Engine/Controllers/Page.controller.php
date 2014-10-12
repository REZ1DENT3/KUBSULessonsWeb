<?php

class Page
{

    public function action_index()
    {

        global $db, $handler, $tpl;

        $page = $db->query(

            "SELECT title,
              content,
              datetime
            FROM pages
            WHERE url=?",

            strtolower(ProcessingRequest::get(
                strtolower(__CLASS__), true, 'index'))

        )->fetch(PDO::FETCH_ASSOC);

        $handler->is404($page);

        $tpl->assign([

            'title' => $page['title'],
            'content' => $page['content'],
            'date_create_page' => $page['datetime'],
            'date_of_life' => date('Y', time())

        ]);

    }

}