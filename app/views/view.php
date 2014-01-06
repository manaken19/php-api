<?php

class View
{
    public function render($filepath, $content_data)
    {
        if ($format === '404') {
            header("HTTP/1.1 400 Bad Request");
            require_once(dirname(__FILE__) . '/template/404.html');
        } else {
            require_once(dirname(__FILE__) . '/items/' . $filepath . '.php');
        }
    }
}