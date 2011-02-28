<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use Unit\Base\Http\Response\MockUp;

use LiveTest\TestCase\General\Html\RegExNotPresent;

use Base\Www\Uri;

class RegExNotPresentTest extends \PHPUnit_Framework_TestCase
{
  public function testRegExFound()
  {
    $testCase = new RegExNotPresent();
    $testCase->init( '^a(.*)b^' );

    $response = new MockUp();
    $response->setBody('acdefgb');

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }

  public function testRegExNotFound()
  {
    $testCase = new RegExNotPresent();
    $testCase->init( '^a(.*)b^' );

    $response = new MockUp();
    $response->setBody('bcdefg');

    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }
}