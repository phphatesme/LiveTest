<?php

namespace Test\Unit\LiveTest\Extensions;

use Base\Http\Response\Zend;

use Annovent\Event\Dispatcher;

use Base\Http\Response\Response;

use Base\Timer\Timer;

use LiveTest\Listener\Sleep;

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
    $response = new Zend(new \Zend_Http_Response(200, array()));

    $timer = new Timer();
    $this->listener->handleConnectionStatus( new ConnectionStatus(ConnectionStatus::SUCCESS, new Uri( 'http://www.example.com')));
    $this->assertGreaterThanOrEqual($this->sleepTime, $timer->stop());
  }
}