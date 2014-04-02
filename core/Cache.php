<?php

namespace Core;

/**
* Cache Class.
*
* @author Yosuke Ohshima
*/
class Cache
{
    public $memcached;
    public function __construct()
    {
    }

    public function set($key, $data)
    { 
        $m = new \Memcached();
        $m->addServer('localhost', 11211);
        $result = $m->set($key, $data, time() + 60);
        if (! $result){
            return false;
        }

        return true;
    }

    public function get($key= 'json')
    {
        $m = new \Memcached();
        $m->addServer('localhost', 11211);

        $result = $m->get($key);
        
        if (! $result){
            return false;
        }
      
        return $result;
    }
}
