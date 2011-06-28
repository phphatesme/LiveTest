<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun;

use LiveTest\Event\Dispatcher;

use LiveTest\TestRun\Result\Result;

use Base\Http\Client\Client;
use Base\Http\ConnectionStatus;
use Base\Http\Response\Response;
use Base\Timer\Timer;

class Run
{
  /**
   * All properties for the test run
   * @var Properties
   */
  private $properties;
  
  /**
   * The injected http client used to fire http request for the given pages.
   * @var Client
   */
  private $httpClient = null;
  
  /**
   * The injected event dispatcher. Used to notify the registered listeners.
   * @var Dispatcher
   */
  private $eventDispatcher;
  
  /**
   * @param Properties $properties
   * @param Client $httpClient
   * @param Dispatcher $dispatcher
   */
  public function __construct(Properties $properties, array $httpClients, Dispatcher $dispatcher)
  {
    $this->eventDispatcher = $dispatcher;
    $this->httpClients = $httpClients;
    $this->properties = $properties;
  }
  
  /**
   * This function creates and initializes the test case object using the init method.
   *
   * @param Test $test
   * @return TestCase
   */
  private function getInitializedTestCase(Test $test)
  {
    $testCaseName = $test->getClassName();
    
    if (class_exists($testCaseName))
    {
      $testCaseObject = new $testCaseName();
    }
    else
    {
      // @todo use a specialized exception
      throw new \Exception('Class not found (' . $testCaseName . '). ');
    }
    \LiveTest\Functions::initializeObject($testCaseObject, $test->getParameter());
    
    return $testCaseObject;
  }
  
  /**
   * This function runs the given test set with the assigned response.
   *
   * @notify LiveTest.Run.HandleResult
   *
   * @param TestSet $testSet
   * @param Response $response
   */
  private function runTests(TestSet $testSet, Response $response, $sessionName)
  {
    foreach ($testSet->getTests() as $test)
    {
      $runStatus = Result::STATUS_SUCCESS;
      $runMessage = '';
      
      try
      {
        $testCase = $this->getInitializedTestCase($test);
        $testCase->test($response, $testSet->getRequest());
      }
      catch (\LiveTest\TestCase\Exception $e)
      {
        $runStatus = Result::STATUS_FAILED;
        $runMessage = $e->getMessage();
      }
      catch (\Exception $e)
      {
        $runStatus = Result::STATUS_ERROR;
        $runMessage = $e->getMessage();
      }
      $result = new Result($test, $runStatus, $runMessage, $testSet->getRequest(), $sessionName);
      $this->eventDispatcher->simpleNotify('LiveTest.Run.HandleResult', array ('result' => $result, 'response' => $response));
    }
  }
  
  /**
   * This function sends a http request and assigns the response to the test cases.
   *
   * @notify LiveTest.Run.HandleConnectionStatus
   *
   * @param TestSet $testSet
   */
  private function runTestSet(TestSet $testSet, $sessionName)
  {
    $connectionStatusValue = ConnectionStatus::SUCCESS;
    $connectionStatusMessage = '';
    
    try
    {
      $response = $this->httpClients[$sessionName]->request($testSet->getRequest());
    }
    catch (\Zend\Http\Exception $e)
    {
      $connectionStatusValue = ConnectionStatus::ERROR;
      $connectionStatusMessage = $e->getMessage();
    }
    
    $connectionStatus = new ConnectionStatus($connectionStatusValue, $testSet->getRequest(), $connectionStatusMessage);
    
    $this->eventDispatcher->simpleNotify('LiveTest.Run.HandleConnectionStatus', array ('connectionStatus' => $connectionStatus));
    
    if ($connectionStatusValue === ConnectionStatus::SUCCESS)
    {
      $this->runTests($testSet, $response, $sessionName);
    }
  }
  
  /**
   * This function runs all test sets defined in the properties file.
   *
   * @notify LiveTest.Run.PostRun
   * @notify LiveTest.Run.PreRun
   */
  public function run()
  {
    $this->eventDispatcher->simpleNotify('LiveTest.Run.PreRun', array ('properties' => $this->properties));
    
    // @todo move timer to runner.php
    $timer = new Timer();
    
    foreach ($this->properties->getTestSets() as $sessionName => $testSets)
    {
      foreach ($testSets as $testSet)
      {
        $this->runTestSet($testSet, $sessionName);
      }
    }
    
    $information = new Information($timer->stop(), $this->properties->getDefaultDomain());
    
    $this->eventDispatcher->simpleNotify('LiveTest.Run.PostRun', array ('information' => $information));
  }
}