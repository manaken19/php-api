<?php

require_once (dirname(__FILE__)."/../../app/controllers/itemController.php");

class ItemControllerTest extends PHPUnit_Framework_TestCase
{
    private $obj;

    public function setUp()
    {
        $this->obj = new ItemController();
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
