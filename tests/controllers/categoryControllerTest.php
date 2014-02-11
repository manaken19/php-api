<?php

require_once (dirname(__FILE__)."/../../app/controllers/CategoryController.php");

class CategoryControllerTest extends PHPUnit_Framework_TestCase
{
    private $obj;

    public function setUp()
    {
        $this->obj = new CategoryController();
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
        $this->assertTrue(true);
    }
}
