<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use Unit\Base\Http\Response\MockUp;

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

    $response = new MockUp();
    $response->setBody('<html></html>');

    $uri = new Uri('http://www.example.com/');

    $stub->test($response, $uri);

    $this->assertEquals($uri, $stub->getUri());
  }
}