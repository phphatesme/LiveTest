<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use Base\Www\Uri;

use LiveTest\TestCase\General\Html\RegExPresent;

class RegExPresentTest extends \PHPUnit_Framework_TestCase
{
  public function testRegExFound()
  {
    $testCase = new RegExPresent();
    $testCase->init( '^a(.*)b^' );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('acdefgb'));

    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }

  public function testRegExNotFound()
  {
    $testCase = new RegExPresent();
    $testCase->init( '^a(.*)b^' );

    $response = $this->getMock('\Base\Http\Response\Response', array('getStatus', 'getBody'));
    $response->expects($this->any())
                 ->method('getBody')
                 ->will($this->returnValue('bcdefg'));

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }
}