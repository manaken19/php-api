<?php

namespace Core;

/**
* Cache Class.
*
* @author Yosuke Ohshima
*/
class Cache
{
    public function __construct()
    {
        $memcached = new Memcached();
        $memcached->addServer('localhost', 11211);
    }

    public function set($key, $data)
    {
        $result = $memcached->set($key, $data, time() + 60);
        if (! $result){
            return false;
        }

        return ture;
    }

    public function get($key)
    {
        $result = $memcached->get($key);
      
        return $result;
    }
}
