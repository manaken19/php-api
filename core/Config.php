<?php
namespace Core;

class Config
{
    public function __construct()
    {

    }

    public function get($name, $default = null)
    {
        $result = require_once CONFIGPARH . $name . '.php';

        return $result;
   }
}