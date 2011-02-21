<?php

namespace Test\Unit\LiveTest\Listener;

use Annovent\Event\Dispatcher;

use Base\Http\Response\Response;
use Base\Http\Response\Zend;

use Base\Www\Uri;
use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\Listener\ProgressBar;

class ProgressBarTest extends \PHPUnit_Framework_TestCase
{
  private $listener;

  protected function setUp()
  {
    $this->listener = new ProgressBar('', new Dispatcher());
  }

  public function testHandleResult()
  {
    $test = new Test('', '', new \Zend_Config(array()));
    $response = new Zend(new \Zend_Http_Response(200, array()));

    ob_start();
    $result = new Result($test, Result::STATUS_SUCCESS, '', '');
    $this->listener->handleResult($result, $response);

    $result = new Result($test, Result::STATUS_FAILED, '', '');
    $this->listener->handleResult($result, $response);

    $result = new Result($test, Result::STATUS_ERROR, '', '');
    $this->listener->handleResult($result, $response);

    $output = ob_get_contents();
    ob_clean();

    $this->assertEquals('  Running: *fe', $output);
  }

  public function testHandleConnectionStatusSuccess()
  {
    ob_start();
    $this->listener->handleConnectionStatus(new ConnectionStatus(ConnectionStatus::SUCCESS, new Uri('http://www.example.com')));
    $output = ob_get_contents();
    ob_clean();
    $this->assertEquals('', $output);
  }

  public function testHandleConnectionStatusError()
  {
    ob_start();
    $this->listener->handleConnectionStatus(new ConnectionStatus(ConnectionStatus::ERROR, new Uri('http://www.example.com')));
    $output = ob_get_contents();
    ob_clean();
    $this->assertEquals('  Running: E', $output);
  }
}