<?php
/**
 * The database settings.
 */
class Database_Setting
{
    private static $_config = array(
        'dns'  => 'mysql:dbname=php_api;host=127.0.0.1',
        'user' => 'root',
        'pass' => '',
    );

    public function db_config()
    {
        return self::$_config;
    }
}
