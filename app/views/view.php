<?php

class View
{
    public function render($format, $content_data)
    {
        if ($format === '404') {
            header("HTTP/1.1 400 Bad Request");
            require('/app/kato_lesson/ohshima_api/app/views/template/404.html');
        } else {
            require('/app/kato_lesson/ohshima_api/app/views/items/' . $format . '.php');
        }
    }
}