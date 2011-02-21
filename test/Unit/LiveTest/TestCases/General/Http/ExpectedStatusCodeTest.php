<?php

namespace Test\Unit\LiveTest\TestCases\General\Http;

use Base\Www\Uri;
use Base\Http\Response\Zend;

use LiveTest\TestCase\General\Http\ExpectedStatusCode;

class ExpectedStatusCodeTest extends \PHPUnit_Framework_TestCase
{
  public function testNegativeTest()
  {
    $testCase = new ExpectedStatusCode();
    $testCase->init(400);

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody'));
    $response->expects($this->any())
                 ->method('getStatus')
                 ->will($this->returnValue(500));

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test($response, new Uri('http://www.example.com'));
  }

  public function testPositiveTest()
  {
    $testCase = new ExpectedStatusCode();
    $testCase->init(400);

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody'));
    $response->expects($this->any())
                 ->method('getStatus')
                 ->will($this->returnValue(400));

    $testCase->test($response, new Uri('http://www.example.com'));
  }
}