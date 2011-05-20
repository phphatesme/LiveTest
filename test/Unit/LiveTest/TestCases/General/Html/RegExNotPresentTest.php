<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use LiveTest\Config\Request\Symfony;

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
    $testCase->test( $response, Symfony::create(new Uri('http://www.example.com/')) );
  }

  public function testRegExNotFound()
  {
    $testCase = new RegExNotPresent();
    $testCase->init( '^a(.*)b^' );

    $response = new MockUp();
    $response->setBody('bcdefg');

    $testCase->test( $response, Symfony::create(new Uri('http://www.example.com/')) );
  }

  public function testAnOtherRegExNotFound()
  {
    $testCase = new RegExNotPresent();
    $testCase->init( '@^database.*error$@' );

    $response = new MockUp();
    $response->setBody('database connection error');
    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, Symfony::create(new Uri('http://www.example.com/')) );

    $response->setBody('database connection established');
    $testCase->test( $response, Symfony::create(new Uri('http://www.example.com/')) );
  }
}