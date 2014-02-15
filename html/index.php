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
 * Path difine. 
 */
define('DOCROOT', __DIR__.DIRECTORY_SEPARATOR);
define('APPPATH', realpath(__DIR__.'/../app/').DIRECTORY_SEPARATOR);
define('COREPATH', realpath(__DIR__.'/../core/').DIRECTORY_SEPARATOR);
define('CONFIGPARH', realpath(__DIR__.'/../config/').DIRECTORY_SEPARATOR);

require APPPATH.'bootstrap.php';


try
{
    // 初期化処理
    $request    = new \Core\Request();
    $db_manager = new \Core\DbManager();

    $controller_name = $request->getControllerName();

    // @TODO:ここの処理をルータークラスに処理させたい
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
