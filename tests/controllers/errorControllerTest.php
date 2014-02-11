<?php

require_once (dirname(__file__)."/../../app/controllers/ErrorController.php");

class errorcontrollertest extends phpunit_framework_testcase
{
    private $obj;

    public function setup()
    {
        $this->obj = new ErrorController();
    }

    public function teardown()
    {
        $this->obj = null;
    }

    public function testsearch()
    {
        $this->asserttrue(true);
    }

    public function testdetail()
    {
        $this->asserttrue(true);
    }
}
