<?php
/**
 * OreOre_framework.
 *
 * @version    1.0
 * @author     Yosuke Ohshima
 */
use \Core\Request;
use \Model;

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
   // $controller_name = Request::getPathInfo();

    $controller_name = new Request();

    switch ($controller_name) {
        case 'item':
            $items_controller = new ItemsController();
            $item_controller->detail();
            break;
        case 'items':
            $items_controller = new ItemsController();
            $item_controller->search();
            break;
        case 'categories':
            $categories_controller = new CategoriesController();
            $categories_controller->categories();
            break;
        default:
            //TODO:なんらかのエラー処理
            break;
    }
}
catch (HttpNotFoundException $e)
{
        throw $e;
}
