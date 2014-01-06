<?php
/**
 * The database settings.
 */
class DbConfig
{
	public function config()
	{
	    $params = array(
	        //'dsn' => 'mysql:host=localhost;dbname=ohshimaapi',
            'dns' => 'mysql:dbname=ohshimaapi;host=127.0.0.1',
	        'user' => '',
	        'password' => ''
	    );

		return $params;
    }
}