<?php
namespace Unit\LiveTest\TestRun\Helper;


use LiveTest\TestRun\Properties;
use Base\Http\Response\Response;
use LiveTest\TestRun\Result\Result;
use Annovent\Event\Dispatcher;
use LiveTest\Listener\Listener;

class HandleResultListener implements Listener
{
  private $handleResultCalled = false;
  private $handleConnectionStatusCalled = false;
  private $result;
  private $response;

  public function __construct($runId, Dispatcher $eventDispatcher)
  {

  }

  /**
   * @event LiveTest.Run.HandleResult
   */
  public function handleResult($result, $response)
  {
    $this->handleResultCalled = true;
    $this->result = $result;
    $this->response = $response;
    
  }
  
  public function getResult()
  {
  	return $this->result;
  }
  
  public function getResponse()
  {
  	return $this->response;
  }

  public function isHandleResultCalled()
  {
    return $this->handleResultCalled;
  }

}