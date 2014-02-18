<?php

namespace Core;

/**
 * View Class.
 *
 * @author Yosuke Ohshima
 */
class View
{
    public function render($action, $format, $contents)
    {
    	switch ($action) {
    		case 'search':
                require_once(APPPATH . 'views/items/search.' . $format . 'json.php');
    			break;
    		
    		case 'detail':
                require_once(dirname(__FILE__) . '/items/detail.' . $format . '.php');
    			break;
    		
    		case 'error':
    		default:
                header("HTTP/1.1 404 Not Found");
    			break;
    	}
    }
}