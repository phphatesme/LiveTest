<?php

namespace Test\Unit\LiveTest\TestCases\General\Http;

use LiveTest\Connection\Request\Symfony;

use LiveTest\TestCase\General\Http\HeaderExists;

use Unit\Base\Http\Response\MockUp;

use Base\Www\Uri;
use Base\Http\Response\Zend;

use LiveTest\TestCase\General\Http\ExpectedStatusCode;

class HeaderExistsTest extends \PHPUnit_Framework_TestCase
{
  public function testNegativeTest()
  {
    $testCase = new HeaderExists();
    $testCase->init('Cache');

    $response = new MockUp();
    $response->setHeaders(array( 'Cache' => '' ));

    $testCase->test($response, Symfony::create(new Uri('http://www.example.com/')));
  }

  public function testPositiveTest()
  {
    $testCase = new HeaderExists();
    $testCase->init('Cache');

    $response = new MockUp();
    $response->setHeaders(array( 'No-Cache' => '' ));

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test($response, Symfony::create(new Uri('http://www.example.com/')));
  }
}