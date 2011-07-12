<?php
namespace Unit\LiveTest\Result\TestRun;

use Unit\Base\Http\Response\MockUp;

use LiveTest\Connection\Request\Symfony;

use LiveTest\TestRun\Result\Result;

use LiveTest\TestRun\Test;
use Base\Www\Uri;

class ResultTest extends \PHPUnit_Framework_TestCase
{

  public function testGetter()
  {
    $test = new Test('name', 'className');
    $status = Result::STATUS_SUCCESS;
    $message = 'foo';
    $request = Symfony::create(new Uri('http://www.example.com/'));

    $result = new Result($test, $status, $message, $request, new MockUp(), 'mySession');

    $this->assertEquals($test, $result->getTest());
    $this->assertEquals($status, $result->getStatus());
    $this->assertEquals($message, $result->getMessage());
    $this->assertEquals($request->getUri(), $result->getRequest()->getUri());
  }

}
