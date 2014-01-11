<?php

require_once '../app/controllers/items_controller.php';

$item_controller = new ItemsController();

if (isset($_SERVER['PATH_INFO'])) {

    $uri_segments = array();
    $uri_segments = explode('/', ltrim($_SERVER['PATH_INFO'], '/'));

} else {

    $item_controller->action_error('404');

}

switch ($uri_segments[0]) {

	case 'item':
        $item_controller->action_detail($_GET);
    	break;

 	case 'items':
        $item_controller->action_search($_GET);
 		break;

	default:
        $item_controller->action_error('405');
    	break;
        
}