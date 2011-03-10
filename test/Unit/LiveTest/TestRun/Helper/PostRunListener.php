<?php
namespace Unit\LiveTest\TestRun\Helper;


use LiveTest\TestRun\Information;
use LiveTest\TestRun\Properties;
use Base\Http\Response\Response;
use LiveTest\TestRun\Result\Result;
use Annovent\Event\Dispatcher;
use LiveTest\Listener\Listener;

class PostRunListener implements Listener
{
  private $postRunCalled = false;
  private $information;

  public function __construct($runId, Dispatcher $eventDispatcher)
  {

  }

  /**
   * @event LiveTest.Run.PostRun
   */
  public function postRun(Information $information)
  {
    $this->postRunCalled = true;
    $this->information = $information;
  }

  public function ispostRunCalled()
  {
    return $this->postRunCalled;
  }

  public function getInformation( )
  {
    return $this->information;
  }
}