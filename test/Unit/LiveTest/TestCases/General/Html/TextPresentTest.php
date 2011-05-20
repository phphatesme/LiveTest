<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use LiveTest\Config\Request\Symfony;

use Unit\Base\Http\Response\MockUp;

use LiveTest\TestCase\General\Html\TextPresent;

use Base\Www\Uri;

class TextPresentTest extends \PHPUnit_Framework_TestCase
{
  public function testTextFoundBeginning()
  {
    $testCase = new TextPresent();
    $testCase->init( 'abc' );

    $response = new MockUp();
    $response->setBody('abcdefg');

    $testCase->test( $response, Symfony::create(new Uri('http://www.example.com/')) );
  }

  public function testTextFoundMiddle()
  {
    $testCase = new TextPresent();
    $testCase->init( 'abc' );

    $response = new MockUp();
    $response->setBody('1234abcdefg');

    $testCase->test( $response, Symfony::create(new Uri('http://www.example.com/')) );
  }

  public function testTextNotFound()
  {
    $testCase = new TextPresent();
    $testCase->init( 'abc' );

    $response = new MockUp();
    $response->setBody('bcdefg');

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, Symfony::create(new Uri('http://www.example.com/')) );
  }
}