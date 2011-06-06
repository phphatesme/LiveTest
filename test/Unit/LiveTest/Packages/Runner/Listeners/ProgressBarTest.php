<?php

namespace Test\Unit\LiveTest\Packages\Runner\Listeners;

use LiveTest\Config\Request\Symfony as Request;

use Unit\Base\Http\Response\MockUp;

use LiveTest\Event\Dispatcher;

use Unit\Base\Http\Response;

use Base\Www\Uri;
use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\Packages\Runner\Listeners\ProgressBar;

class ProgressBarTest extends \PHPUnit_Framework_TestCase
{
  private $listener;

  protected function setUp()
  {
    $this->listener = new ProgressBar('', new Dispatcher());
  }

  public function testHandleResult()
  {
    $test = new Test('', '');

    $response = new MockUp();
    $response->setStatus(200);

    ob_start();
    $result = new Result($test, Result::STATUS_SUCCESS, '', Request::create(new Uri( 'http://www.example.com')));
    $this->listener->handleResult($result, $response);

    $result = new Result($test, Result::STATUS_FAILED, '', Request::create(new Uri( 'http://www.example.com')));
    $this->listener->handleResult($result, $response);

    $result = new Result($test, Result::STATUS_ERROR, '', Request::create(new Uri( 'http://www.example.com')));
    $this->listener->handleResult($result, $response);

    $output = ob_get_contents();
    ob_clean();

    $this->assertEquals('  Running: *fe', $output);
  }

  public function testHandleConnectionStatusSuccess()
  {
    ob_start();
    $this->listener->handleConnectionStatus(new ConnectionStatus(ConnectionStatus::SUCCESS, Request::create(new Uri('http://www.example.com'))));
    $output = ob_get_contents();
    ob_clean();
    $this->assertEquals('', $output);
  }

  public function testHandleConnectionStatusError()
  {
    ob_start();
    $this->listener->handleConnectionStatus(new ConnectionStatus(ConnectionStatus::ERROR, Request::create(new Uri('http://www.example.com'))));
    $output = ob_get_contents();
    ob_clean();
    $this->assertEquals('  Running: E', $output);
  }
}