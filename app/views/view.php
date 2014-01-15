<?php

class View
{
    public function render($action, $content_data)
    {
    	switch ($action) {
    		case 'search':
                require_once(dirname(__FILE__) . '/items/search.' . $content_data['format'] . '.php');
    			break;
    		
    		case 'detail':
                require_once(dirname(__FILE__) . '/items/detail' . $content_data['format'] . '.php');
    			break;
    		
    		case 'error':
                require_once(dirname(__FILE__) . '/template/404.html');
    			break;
    		
    		default:
                require_once(dirname(__FILE__) . '/template/404.html');
    			break;
    	}
    }
}