<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use LiveTest\Connection\Request\Symfony;

use Unit\Base\Http\Response\MockUp;

use Base\Www\Uri;

use LiveTest\TestCase\General\Html\RegExPresent;

class RegExPresentTest extends \PHPUnit_Framework_TestCase
{
  public function testRegExFound()
  {
    $testCase = new RegExPresent();
    $testCase->init( '^a(.*)b^' );

  $response = new MockUp();
    $response->setBody('acdefgb');

    $testCase->test( $response, Symfony::create(new Uri('http://www.example.com/')) );
  }

  public function testRegExNotFound()
  {
    $testCase = new RegExPresent();
    $testCase->init( '^a(.*)b^' );

    $response = new MockUp();
    $response->setBody('bcdefg');

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, Symfony::create(new Uri('http://www.example.com/')) );
  }
}