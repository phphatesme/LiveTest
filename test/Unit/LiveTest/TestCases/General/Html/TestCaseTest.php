<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use Base\Www\Uri;

use LiveTest\TestCase\General\Html\TestCase;

class TestCaseTest extends \PHPUnit_Framework_TestCase
{
  public function testTest()
  {
    $stub = $this->getMockForAbstractClass('\LiveTest\TestCase\General\Html\TestCase');
    $stub->expects($this->any())
         ->method('runTest')
         ->will($this->returnValue(TRUE));

    $response = $this->getMock('\Base\Http\Response\Response',
        array('getStatus', 'getBody', 'getDuration'));
    $response->expects($this->any())
             ->method('getBody')
             ->will($this->returnValue('<html></html>'));

    $uri = new Uri('http://www.example.com/');

    $stub->test($response, $uri);

    $this->assertEquals($uri, $stub->getUri());
  }
}
