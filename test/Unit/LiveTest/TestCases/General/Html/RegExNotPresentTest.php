<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use LiveTest\TestCase\General\Html\RegExNotPresent;

use Base\Www\Uri;

class RegExNotPresentTest extends \PHPUnit_Framework_TestCase
{
  public function testRegExFound()
  {
    $testCase = new RegExNotPresent();
    $testCase->init( '^a(.*)b^' );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('acdefgb'));

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }

  public function testRegExNotFound()
  {
    $testCase = new RegExNotPresent();
    $testCase->init( '^a(.*)b^' );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('bcdefg'));

    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }
}