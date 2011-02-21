<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use Base\Www\Uri;

use LiveTest\TestCase\General\Html\Size;

class SizeTest extends \PHPUnit_Framework_TestCase
{
  public function testBadConfiguration( )
  {
    $testCase = new Size();

    $this->setExpectedException('\LiveTest\ConfigurationException');
    $testCase->init();
  }

  public function testBadMinSize( )
  {
    $testCase = new Size();
    $testCase->init( 10 );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('<body>'));

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, new Uri('http://www.example.com') );
  }

  public function testGoodMinSize( )
  {
    $testCase = new Size();
    $testCase->init( 2 );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('<body>'));

    $testCase->test( $response, new Uri('http://www.example.com') );
  }

  public function testBadMaxSize( )
  {
    $testCase = new Size();
    $testCase->init( null, 2 );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('<body>'));

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, new Uri('http://www.example.com') );
  }

  public function testGoodMaxSize( )
  {
    $testCase = new Size();
    $testCase->init( null, 10 );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('<body>'));

    $testCase->test( $response, new Uri('http://www.example.com') );
  }
}