<?php

namespace Test\Unit\LiveTest\Listener;

use Base\Www\Uri;

use Base\Http\Response\Zend;

use Annovent\Event\Dispatcher;

use Base\Http\Response\Response;

use Base\Config\Yaml;

use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Test;
use LiveTest\Listener\HtmlDocumentLog;

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
    $response = new Zend(new \Zend_Http_Response(200, array(), '<body></body>'));

    $result = new Result($test, Result::STATUS_FAILED, '', new Uri('http://www.example.com'));

    $this->listener->handleResult($result, $response);

    $this->assertTrue(file_exists($this->fullLogPath . $this->createdFile));
  }

  public function testHandleResultLogStatuses()
  {
    $this->listener->init(__DIR__ . DIRECTORY_SEPARATOR . $this->logPath, array( Result::STATUS_SUCCESS) );

    $test = new Test('', '');
    $response = new Zend(new \Zend_Http_Response(200, array(), '<body></body>'));
    $result = new Result($test, Result::STATUS_FAILED, '', new Uri( 'http://www.example.com'));

    $this->listener->handleResult($result, $response);

    $this->assertFalse(file_exists($this->logPath . '/' . $this->createdFile));
  }
}