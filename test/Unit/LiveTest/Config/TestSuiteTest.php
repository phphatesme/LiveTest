<?php

namespace Test\Unit\LiveTest\Config;

use LiveTest\Connection\Session\Session;

use LiveTest\Config\TestSuite;
use Base\Www\Uri;

use LiveTest\Connection\Request\Symfony as Request;

class TestSuiteTest extends \PHPUnit_Framework_TestCase
{
  public function testIncludePage()
  {
    $config = new TestSuite(new Session(new Uri('http://www.example.com')));
    $config->getCurrentSession()->includePageRequest(Request::create(new Uri('http://www.example.com/'),'get'));
    $config->getCurrentSession()->includePageRequest(Request::create(new Uri('http://www.phphatesme.com/'),'get'));

    $pageRequests = $config->getCurrentSession()->getPageRequests();
    $this->assertEquals(2, count($pageRequests));
    
    $validatePages = array('http://www.example.com/', 'http://www.phphatesme.com/');
    
    $counter = 0;
    foreach($pageRequests as $aPageRequest)
    {
      $this->assertEquals($validatePages[$counter], $aPageRequest->getUri());
      $counter++;
    }

  }

  public function testCreatePageRequestsFromParameters()
  {
    $includedPages = array('http://www.example.com/','http://www.phphatesme.com/');

    $config = new TestSuite(new Session(new Uri('http://www.example.com')));
    $pageRequestsToInclude = Request::createRequestsFromParameters($includedPages);

    $config->getCurrentSession()->includePageRequests($pageRequestsToInclude);

    $pageRequests = $config->getCurrentSession()->getPageRequests();
    $this->assertEquals(count($includedPages), count($pageRequests));
  }

  public function testCreatePageRequestsFromParametersSortOrder()
  {

  }

  public function testExcludePageRequest()
  {
    $includedPages = array('http://www.example.com/','http://www.phphatesme.com/');

    $config = new TestSuite(new Session(new Uri('http://www.example.com')));
    $createdPageRequests = Request::createRequestsFromParameters($includedPages);
    $config->getCurrentSession()->includePageRequests($createdPageRequests);

    $config->getCurrentSession()->excludePageRequest(Request::create(new Uri('http://www.example.com/')));
    $pageRequests = $config->getCurrentSession()->getPageRequests();
    
    $this->assertEquals(1, count($pageRequests));

    //$this->assertEquals('http://www.phphatesme.com/', $pageRequests['http://www.phphatesme.com/']->getUri());
  }

  public function testExcludePageRequests()
  {
    $includedPages = array('http://www.example.com/','http://www.phphatesme.com/');

    $config = new TestSuite(new Session(new Uri('http://www.example.com')));
    $pageRequestsToExclude = Request::createRequestsFromParameters($includedPages);
    $config->getCurrentSession()->excludePageRequests($pageRequestsToExclude);

    $pageRequests = $config->getCurrentSession()->getPageRequests();
    $this->assertEquals(0, count($pageRequests));
  }

  public function testCreateTestCase()
  {
    $config = new TestSuite(new Session(new Uri('http://www.example.com')));
    $newConfig = $config->createTestCase('MyTestCase', 'MyClassName', array('foo' => 'bar'));
    $newConfig = $config->createTestCase('MyTestCase2', 'MyClassName2', array('foo' => 'bar'));

    $testCases = $config->getTestCases();

    $this->assertEquals(2, count($testCases));
    $this->assertEquals('MyClassName', $testCases[0]['className']);
    $this->assertNotEquals($newConfig, $config);
  }
}