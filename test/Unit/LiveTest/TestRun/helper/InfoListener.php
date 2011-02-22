<?php

use LiveTest\TestRun\Properties;
use Base\Http\Response\Response;
use LiveTest\TestRun\Result\Result;
use Annovent\Event\Dispatcher;
use LiveTest\Listener\Listener;

class InfoListener implements Listener
{
  private $preRunCalled = false;
  private $postRunCalled = false;
  private $handleResultCalled = false;
  private $handleConnectionStatusCalled = false;

  public function __construct($runId, Dispatcher $eventDispatcher)
  {

  }

  /**
   * @event LiveTest.Run.HandleResult
   */
  public function handleResult()
  {
    $this->handleResultCalled = true;
  }

  public function isHandleResultCalled()
  {
    return $this->handleResultCalled;
  }


  /**
   * @event LiveTest.Run.HandleConnectionStatus
   */
  public function handleConnectionStatus()
  {
    $this->handleConnectionStatusCalled = true;
  }

  public function isHandleConnectionStatusCalled()
  {
    return $this->handleConnectionStatusCalled;
  }
}