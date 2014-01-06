<?php

require_once '../app/controllers/item_controller.php';

$item_controller = new ItemController();

if (isset($_SERVER['PATH_INFO'])) {
    $uri_segments = array();
    $uri_segments = explode('/', ltrim($_SERVER['PATH_INFO'], '/'));
} else {
    $item_controller->not_found();
}

switch ($uri_segments[0]) {
	case 'item':
        $item_controller->item_detail($_GET);
    	break;
 	case 'items':
        $item_controller->item_search($_GET);
 		break;
	default:
        $item_controller->not_found();
    	break;
}