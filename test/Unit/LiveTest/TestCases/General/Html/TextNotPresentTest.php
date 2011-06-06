<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use LiveTest\Config\Request\Symfony;

use Unit\Base\Http\Response\MockUp;

use LiveTest\TestCase\General\Html\TextNotPresent;

use Base\Www\Uri;

class TextNotPresentTest extends \PHPUnit_Framework_TestCase
{
  public function testTextFoundBeginning()
  {
    $testCase = new TextNotPresent();
    $testCase->init('abc');

    $response = new MockUp();
    $response->setBody('abcdefg');

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test($response, Symfony::create(new Uri('http://www.example.com/')));
  }

  public function testTextFoundMiddle()
  {
    $testCase = new TextNotPresent();
    $testCase->init('abc');

    $response = new MockUp();
    $response->setBody('1234abcdefg');

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test($response, Symfony::create(new Uri('http://www.example.com/')));
  }

  public function testTextNotFound()
  {
    $testCase = new TextNotPresent();
    $testCase->init('abc');

    $response = new MockUp();
    $response->setBody('bcdefg');

    $testCase->test($response, Symfony::create(new Uri('http://www.example.com/')));
  }
}