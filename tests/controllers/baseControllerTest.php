<?php

require_once (dirname(__FILE__).'/../../controlers/BaseController.phpj');

class BaseControllerTest extends PHPUnit_Framework_TestCase 
{
    private $obj;

    public function setUp()
    {
        $this->obj = new BaseController();
    }

    public function tearDown()
    {
        $this->obj = null;
    }

    public function testSearch()
    {
        $this->assertTrue(true);

    }

    public function testDetail()
    {
        $test->assertTrue(true);
    }
}