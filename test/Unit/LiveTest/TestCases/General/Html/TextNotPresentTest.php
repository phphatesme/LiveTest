<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use LiveTest\TestCase\General\Html\TextNotPresent;

use Base\Www\Uri;

class TextNotPresentTest extends \PHPUnit_Framework_TestCase
{
  public function testTextFoundBeginning()
  {
    $testCase = new TextNotPresent();
    $testCase->init( 'abc' );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody', 'getDuration'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('abcdefg'));

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }

  public function testTextFoundMiddle()
  {
    $testCase = new TextNotPresent();
    $testCase->init( 'abc' );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody', 'getDuration'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('1234abcdefg'));

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }

  public function testTextNotFound()
  {
    $testCase = new TextNotPresent();
    $testCase->init( 'abc' );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody', 'getDuration'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('bcdefg'));

    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }
}