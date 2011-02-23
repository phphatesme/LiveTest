<?php
namespace Unit\LiveTest\TestRun;

use LiveTest\TestRun\Result\Result;

use LiveTest\TestRun\Test;
use Base\Www\Uri;

class ResultTest extends \PHPUnit_Framework_TestCase
{

  public function testGetter()
  {
    $test = new Test('name', 'className', new \Zend_Config(array()));
    $status = Result::STATUS_SUCCESS;
    $message = 'foo';
    $uri = new Uri('http://www.example.com');
    
    $result = new Result($test, $status, $message, $uri);

    $this->assertEquals($test, $result->getTest());
    $this->assertEquals($status, $result->getStatus());
    $this->assertEquals($message, $result->getMessage());
    $this->assertEquals($uri, $result->getUri());
  }

}
