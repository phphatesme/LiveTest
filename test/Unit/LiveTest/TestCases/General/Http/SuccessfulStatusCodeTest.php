<?php

namespace Test\Unit\LiveTest\TestCases\General\Http;

use Base\Www\Uri;

use Base\Http\Response\Zend;

use LiveTest\TestCase\General\Http\SuccessfulStatusCode;

class SuccessfulStatusCodeTest extends \PHPUnit_Framework_TestCase
{
  public function testNegativeTest()
  {
    $testCase = new SuccessfulStatusCode();

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody', 'getDuration'));
    $response->expects($this->any())
                 ->method('getStatus')
                 ->will($this->returnValue(500));

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test($response, new Uri('http://www.example.com'));
  }

  public function testPositiveTest()
  {
    $testCase = new SuccessfulStatusCode();

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody', 'getDuration'));
    $response->expects($this->any())
                 ->method('getStatus')
                 ->will($this->returnValue(200));

    $testCase->test($response, new Uri('http://www.example.com'));
  }
}
