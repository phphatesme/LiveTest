<?php

namespace Test\Unit\LiveTest\Config;

use LiveTest\Config\TestSuite;

class TestSuiteTest extends \PHPUnit_Framework_TestCase
{
  public function testIncludePage( )
  {
    $config = new TestSuite();
    $config->includePage('http://www.example.com');
    $config->includePage('http://www.phphatesme.com');

    $pages = $config->getPages( );
    $this->assertEquals( 2, count($pages));

    $this->assertEquals('http://www.example.com', $pages['http://www.example.com']);
    $this->assertEquals('http://www.phphatesme.com', $pages['http://www.phphatesme.com']);
  }

  public function testIncludePages( )
  {
    $includedPages = array( 'http://www.example.com', 'http://www.phphatesme.com');

    $config = new TestSuite();
    $config->includePages($includedPages);

    $pages = $config->getPages( );
    $this->assertEquals( count($includedPages), count($pages));
  }

  public function testExcludePage( )
  {
    $includedPages = array( 'http://www.example.com', 'http://www.phphatesme.com');

    $config = new TestSuite();
    $config->includePages($includedPages);

    $config->excludePage('http://www.example.com');

    $pages = $config->getPages( );
    $this->assertEquals( 1, count($pages));

    $this->assertEquals('http://www.phphatesme.com', $pages['http://www.phphatesme.com']);
  }

  public function testExcludePages( )
  {
    $includedPages = array( 'http://www.example.com', 'http://www.phphatesme.com');

    $config = new TestSuite();
    $config->includePages($includedPages);
    $config->excludePages($includedPages);

    $pages = $config->getPages( );
    $this->assertEquals( 0, count($pages));
  }
}