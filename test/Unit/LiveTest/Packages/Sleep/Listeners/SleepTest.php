<?php

namespace Test\Unit\LiveTest\Packages\Sleep\Listeners;

use Unit\Base\Http\Response\MockUp;

use LiveTest\Config\Request\Symfony as Request;

use Base\Http\Response\Zend;

use LiveTest\Event\Dispatcher;

use Base\Http\Response\Response;

use Base\Timer\Timer;

use LiveTest\Packages\Sleep\Listeners\Sleep;

use Base\Www\Uri;
use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class SleepTest extends \PHPUnit_Framework_TestCase
{
  private $sleepTime = 1;

  private $listener;

  public function testHandleResult()
  {
    $this->listener = new Sleep('', new Dispatcher());
    $this->listener->init(1);

    $test = new Test('', '');

    $response = new MockUp();

    $timer = new Timer();
    $this->listener->handleConnectionStatus( new ConnectionStatus(ConnectionStatus::SUCCESS, Request::create(new Uri( 'http://www.example.com'))));
    $this->assertGreaterThanOrEqual($this->sleepTime, $timer->stop());
  }
}