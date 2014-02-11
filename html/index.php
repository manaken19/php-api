<?php
/**
 * OreOre_framework.
 *
 * @version    1.0
 * @author     Yosuke Ohshima
 */

/**
 * error reporting and display errors settings.
 */
error_reporting(-1);
ini_set('display_errors', 1);

/**
 * Document root
 */
define('DOCROOT', __DIR__.DIRECTORY_SEPARATOR);

/*
 * The path to app.
 */
define('APPPATH', realpath(__DIR__.'/../app/').DIRECTORY_SEPARATOR);

/**
 * The path to core.
 */
define('COREPATH', realpath(__DIR__.'/../core/').DIRECTORY_SEPARATOR);

/**
 * Path to config.
 */
define('CONFIGPARH', realpath(__DIR__.'/../config/').DIRECTORY_SEPARATOR);

// Boot the app
require APPPATH.'bootstrap.php';

try
{
    //TODO:RequestクラスだかRouterクラスのなんかを実行するだけで、アプリケーション毎に依存関係ないようにしたい
    $items_controller      = new ItemsController();
    $categories_controller = new CategoriesController();
    $error_controller      = new ErrorController();

    $path_info               = array();
    $path_info['controller'] = Request::getPathInfo();

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
            $error_controller->error();
            break;
    }
}
catch (HttpNotFoundException $e)
{
        throw $e;
}


