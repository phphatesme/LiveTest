<?php

namespace Test\Unit\LiveTest\Listener;

use Base\Http\Response\Zend;

use Annovent\Event\Dispatcher;

use Base\Http\Response\Response;

use Base\Config\Yaml;

use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Test;
use LiveTest\Listener\HtmlDocumentLog;

class HtmlDocumentLogTest extends \PHPUnit_Framework_TestCase
{
  private $logPath = 'logs/';

  private $createdFile = 'http%3A%2F%2Fwww.phphatesme.com';

  private $listener;

  public function setUp()
  {
    $this->listener = new HtmlDocumentLog('', new Dispatcher());
  }

  public function tearDown()
  {
    @unlink($this->logPath . '/' . $this->createdFile);
  }

  public function testHandleResultNoLogStatuses()
  {
    $this->listener->init(__DIR__ . DIRECTORY_SEPARATOR . $this->logPath);

    $test = new Test('', '', new \Zend_Config(array()));
    $response = new Zend(new \Zend_Http_Response(200, array(), '<body></body>'));
    $result = new Result($test, Result::STATUS_FAILED, '', 'http://www.phphatesme.com');

    $this->listener->handleResult($result, $response);

    $this->assertTrue(file_exists($this->logPath . '/' . $this->createdFile));
  }

  public function testHandleResultLogStatuses()
  {
    $this->listener->init(__DIR__ . DIRECTORY_SEPARATOR . $this->logPath, array( Result::STATUS_SUCCESS) );

    $test = new Test('', '', new \Zend_Config(array()));
    $response = new Zend(new \Zend_Http_Response(200, array(), '<body></body>'));
    $result = new Result($test, Result::STATUS_FAILED, '', 'http://www.phphatesme.com');

    $this->listener->handleResult($result, $response);

    $this->assertFalse(file_exists($this->logPath . '/' . $this->createdFile));
  }
}