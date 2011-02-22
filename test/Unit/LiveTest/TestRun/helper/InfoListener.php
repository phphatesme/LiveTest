<?php

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
   * @event LiveTest.Run.PreRun
   */
  public function preRun()
  {
    $this->preRunCalled = true;
  }

  public function isPreRunCalled()
  {
    return $this->preRunCalled;
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
   * @event LiveTest.Run.PostRun
   */
  public function postRun()
  {
    $this->postRunCalled = true;
  }

  public function isPostRunCalled()
  {
    return $this->postRunCalled;
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