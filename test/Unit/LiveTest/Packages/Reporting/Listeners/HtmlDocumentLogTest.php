<?php

namespace Test\Unit\LiveTest\Packages\Reporting\Listeners;

use LiveTest\Config\Request\Symfony as Request;

use Unit\Base\Http\Response\MockUp;

use Base\Www\Uri;

use LiveTest\Event\Dispatcher;

use Base\Config\Yaml;

use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Test;
use LiveTest\Packages\Reporting\Listeners\HtmlDocumentLog;

class HtmlDocumentLogTest extends \PHPUnit_Framework_TestCase
{
  private $logPath = 'logs';
  private $createdFile = 'http%3A%2F%2Fwww.example.com';
  private $fullLogPath;
  private $listener;

  public function setUp()
  {
    $this->listener = new HtmlDocumentLog('1', new Dispatcher());
    $this->fullLogPathInit = __DIR__ . DIRECTORY_SEPARATOR . $this->logPath;
    $this->fullLogPath     = $this->fullLogPathInit.'/1/';
  }

  public function tearDown()
  {
    @unlink($this->fullLogPath . $this->createdFile);
  }

  public function testHandleResultNoLogStatuses()
  {
    $this->listener->init( $this->fullLogPathInit);

    $test = new Test('', '');

    $response = new MockUp();
    $response->setBody('<body></body>');

    $result = new Result($test, Result::STATUS_FAILED, '', Request::create(new Uri('http://www.example.com')));

    $this->listener->handleResult($result, $response);

    $this->assertTrue(file_exists($this->fullLogPath . $this->createdFile));
  }
  
  public function testResultLogException()
  {
    $this->setExpectedException('LiveTest\ConfigurationException');
    $this->listener->init('/', array( Result::STATUS_SUCCESS) );
  }
  
  public function testHandleResultLogStatuses()
  {
    $this->listener->init(__DIR__ . DIRECTORY_SEPARATOR . $this->logPath, array( Result::STATUS_SUCCESS) );

    $test = new Test('', '');

    $response = new MockUp();
    $response->setStatus(200);
    $response->setBody('<body></body>');

    $result = new Result($test, Result::STATUS_FAILED, '',  Request::create(new Uri( 'http://www.example.com')));

    $this->listener->handleResult($result, $response);

    $this->assertFalse(file_exists($this->logPath . '/' . $this->createdFile));
  }
}