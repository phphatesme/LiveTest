<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use LiveTest\Connection\Request\Symfony;

use Unit\Base\Http\Response\MockUp;

use Base\Www\Uri;

use LiveTest\TestCase\General\Html\TestCase;

class TestCaseTest extends \PHPUnit_Framework_TestCase
{
  public function testCaseTest()
  {
    $stub = $this->getMockForAbstractClass('\LiveTest\TestCase\General\Html\TestCase');
    $stub->expects($this->any())
         ->method('runTest')
         ->will($this->returnValue(TRUE));

    $response = new MockUp();
    $response->setBody('<html></html>');

    $request = Symfony::create(new Uri('http://www.example.com/'),'get',array());

    $stub->test($response, $request);

    $this->assertEquals($request->getUri(), $stub->getRequest()->getUri());
  }
}