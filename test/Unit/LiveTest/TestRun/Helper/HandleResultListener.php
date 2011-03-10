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
  private $results = array();
  private $responses = array();

  public function __construct($runId, Dispatcher $eventDispatcher)
  {

  }

  /**
   * @event LiveTest.Run.HandleResult
   */
  public function handleResult($result, $response)
  {
    $this->handleResultCalled = true;
    $this->results[] = $result;
    $this->responses[] = $response;
    
  }
  
  public function getResults()
  {
  	return $this->results;
  }
  
  public function getResponses()
  {
  	return $this->responses;
  }

  public function isHandleResultCalled()
  {
    return $this->handleResultCalled;
  }

}