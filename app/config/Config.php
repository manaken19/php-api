<?php
/**
 * config.
 */
class Config
{
    private static $mysql = array(
        'dns'  => 'mysql:dbname=php_api;host=127.0.0.1',
        'user' => 'root',
        'pass' => '',
    );

    public function getConfig($condition)
    {
        return self::$$condicton;
    }
}
