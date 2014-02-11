<?php

require './bootstrap.php';

$item_controller = new ItemsController();

if (isset($_SERVER['PATH_INFO'])) {
    $uri_segments = array();
    $uri_segments = explode('/', ltrim($_SERVER['PATH_INFO'], '/'));
} else {
    $item_controller->error('404');
}

switch ($uri_segments[0]) {
    case 'item':
        if (isset($uri_segments[1])) {
            $item_controller->detail($_GET, $uri_segments[1]);
        } else {
            $item_controller->error('405');
        }
        break;

    case 'items':
        $item_controller->search($_GET);
        break;

    case 'categories':
        if (isset($uri_segments[1])) {
            $item_controller->category_items($_GET, $uri_segments[1]);
        } else {
            $item_controller->categories($_GET);
        }
        break;

    default:
        $item_controller->error('405');
        break;
}
