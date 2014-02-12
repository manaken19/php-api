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
    $request = new \Core\Request();
    $controller_name = $request->getControllerName();

    switch ($controller_name) {
        case '/item':
            $items = new \Controller\Items();
            $items->detail();
            break;
        case '/items':
            $items = new \Controller\Items();
            $items->search();
            break;
        case '/categories':
            $categories = new \Controller\Categories();
            $categories->categories();
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
