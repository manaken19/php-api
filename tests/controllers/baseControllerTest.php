<?php

require_once (dirname(__FILE__).'/../../controlers/BaseController.php');

class BaseControllerTest extends PHPUnit_Framework_TestCase 
{
    private $obj;

    public function setUp()
    {

        $this->obj = new BaseController();

    }

}