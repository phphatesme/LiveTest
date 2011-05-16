<?php

namespace Test\Unit\LiveTest\Config;

use LiveTest\Config\TestSuite;

use Base\Http\Request\PhmLabs as Request;

class TestSuiteTest extends \PHPUnit_Framework_TestCase
{
  public function testIncludePage()
  {
    $config = new TestSuite();
    $config->includePageRequest(Request::create('http://www.example.com/','get'));
    $config->includePageRequest(Request::create('http://www.phphatesme.com/','get'));

    $pageRequests = $config->getPageRequests();
    $this->assertEquals(2, count($pageRequests));


    $this->assertEquals('http://www.example.com/', $pageRequests['http://www.example.com/']->getUri());
    $this->assertEquals('http://www.phphatesme.com/', $pageRequests['http://www.phphatesme.com/']->getUri());
   
  }

  public function testCreatePageRequestsFromParameters()
  {
    $includedPages = array(0=>array(0=>'http://www.example.com/'),1=>array(0=>'http://www.phphatesme.com/'));

    $config = new TestSuite();
    $pageRequestsToInclude = Request::createRequestsFromParameters($includedPages);
    $config->includePageRequests($pageRequestsToInclude);
    
    $pageRequests = $config->getPageRequests();
    $this->assertEquals(count($includedPages), count($pageRequests));
  }

  public function testExcludePageRequest()
  {
    $includedPages = array('http://www.example.com','http://www.phphatesme.com');
    
    $config = new TestSuite();
    $pageRequests = Request::createRequestsFromParameters($includedPages);
    $config->includePageRequests($pageRequests);
    
    $config->excludePageRequest($pageRequests['http://www.example.com/']);

    $pageRequests = $config->getPageRequests();
    $this->assertEquals(1, count($pageRequests));

    $this->assertEquals('http://www.phphatesme.com', $pageRequests['http://www.phphatesme.com']->getRequestUri());
  }

  public function testExcludePageRequests()
  {
    $includedPages = array('http://www.example.com','http://www.phphatesme.com');

    $config = new TestSuite();
    $pageRequestsToExclude = Request::createRequestsFromParameters($includedPages);
    $config->excludePageRequests($pageRequestsToExclude);

    $pageRequests = $config->getPageRequests();
    $this->assertEquals(0, count($pageRequests));
  }

  public function testCreateTestCase()
  {
    $config = new TestSuite();
    $newConfig = $config->createTestCase('MyTestCase', 'MyClassName', array('foo' => 'bar'));
    $newConfig = $config->createTestCase('MyTestCase2', 'MyClassName2', array('foo' => 'bar'));

    $testCases = $config->getTestCases();

    $this->assertEquals(2, count($testCases));
    $this->assertEquals('MyClassName', $testCases[0]['className']);
    $this->assertNotEquals($newConfig, $config);
  }
}