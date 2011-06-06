<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use LiveTest\Config\Request\Symfony;

use Unit\Base\Http\Response\MockUp;

use Base\Www\Uri;

use LiveTest\TestCase\General\Html\XPath;

class XPathTest extends \PHPUnit_Framework_TestCase
{
  public function testXPathAttributeFound()
  {
    $testCase = new XPath();
    $testCase->init('/html/head/meta[@name="robots"]/attribute::content', '/^bla$/');

    $response = new MockUp();
    $response->setBody('<html><head><meta name="robots" content="bla" /></head></html>');

    $testCase->test($response, Symfony::create(new Uri('http://www.example.com/')));
  }

  public function testXPathAttributeDoesntMatch()
  {
    $testCase = new XPath();
    $testCase->init('/html/head/meta[@name="robots"]/attribute::content', '/^bla$/');

    $response = new MockUp();
    $response->setBody('<html><head><meta name="robots" content="NOMATCH" /></head></html>');

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test($response, Symfony::create(new Uri('http://www.example.com/')));
  }

  public function testXPathAttributeNotFound()
  {
    $testCase = new XPath();
    $testCase->init('/html/head/meta[@name="robots"]/attribute::content', '^bla$');

    $response = new MockUp();
    $response->setBody('<html><head><meta name="WRONGNAME" content="bla" /></head></html>');

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test($response, Symfony::create(new Uri('http://www.example.com/')));
  }

  public function testXPathEmptyHTML()
  {
    $testCase = new XPath();
    $testCase->init('/html/head/meta[@name="robots"]/attribute::content', '^bla$');

    $response = new MockUp();

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test($response, Symfony::create(new Uri('http://www.example.com/')));
  }

  public function testXPathTextFound()
  {
    $testCase = new XPath();
    $testCase->init('/html/head/title', '/^titleBla$/');

    $response = new MockUp();
    $response->setBody('<html><head><title>titleBla</title></head></html>');

    $testCase->test($response, Symfony::create(new Uri('http://www.example.com/')));
  }

  public function testXPathTextDoesntMatch()
  {
    $testCase = new XPath();
    $testCase->init('/html/head/title', '/^titleBla$/');

    $response = new MockUp();
    $response->setBody('<html><head><title>WRONGTITLE</title></head></html>');

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test($response, Symfony::create(new Uri('http://www.example.com/')));
  }

  public function testXPathInvalidXPath()
  {
    $testCase = new XPath();
    $testCase->init('\\bla', '/^titleBla$/');

    $response = new MockUp();
    $response->setBody('<html><head><title>titleBla</title></head></html>');

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test($response, Symfony::create(new Uri('http://www.example.com/')));
  }
}
