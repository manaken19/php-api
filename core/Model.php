<?php

namespace Core;

/**
 * Model Class.
 *
 * @author Yosuke Ohshima
 */
class Model
{
    protected $_db;

    public function __construct()
    {
        $this->_db = new \Core\DbManager();
    }

}
