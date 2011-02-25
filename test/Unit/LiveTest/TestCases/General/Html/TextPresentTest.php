<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use LiveTest\TestCase\General\Html\TextPresent;

use Base\Www\Uri;

class TextPresentTest extends \PHPUnit_Framework_TestCase
{
  public function testTextFoundBeginning()
  {
    $testCase = new TextPresent();
    $testCase->init( 'abc' );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody', 'getDuration'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('abcdefg'));

    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }

  public function testTextFoundMiddle()
  {
    $testCase = new TextPresent();
    $testCase->init( 'abc' );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody', 'getDuration'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('1234abcdefg'));

    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }

  public function testTextNotFound()
  {
    $testCase = new TextPresent();
    $testCase->init( 'abc' );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody', 'getDuration'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('bcdefg'));

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }
}