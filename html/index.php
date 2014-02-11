<?php

require './bootstrap.php';
$items_controller      = new ItemsController();
$categories_controller = new CategoriesController();
$error_controller      = new ErrorController();

$path_info               = array();
$path_info['controller'] = Request::resolvePathInfo();

switch ($path_info['controller']) {
    case 'item':
        $item_controller->detail();
        break;
    case 'items':
        $item_controller->search();
        break;
    case 'categories':
        $categories_controller->categories();
        break;
    default:
        $error_controller->error('405');
        break;
}
