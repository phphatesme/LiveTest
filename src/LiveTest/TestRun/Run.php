<?php

namespace LiveTest\TestRun;

use LiveTest\TestCase\Exception;
use LiveTest\TestRun\Result\Result;

use Annovent\Event\Dispatcher;

use Base\Http\Client\Client;
use Base\Timer\Timer;
use Base\Http\ConnectionStatus;
use Base\Www\Uri;
use Base\Http\Response\Response;

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
   * @var unknown_type
   */
  private $eventDispatcher;

  /**
   * @param Properties $properties
   * @param Client $httpClient
   * @param Dispatcher $dispatcher
   */
  public function __construct(Properties $properties, Client $httpClient, Dispatcher $dispatcher)
  {
    $this->eventDispatcher = $dispatcher;
    $this->httpClient = $httpClient;
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
    $testCaseObject = new $testCaseName();
    \LiveTest\initializeObject($testCaseObject, $test->getParameter()->toArray());

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
  private function runTests(TestSet $testSet, Response $response)
  {
    foreach ($testSet->getTests() as $test)
    {
      $runStatus = Result::STATUS_SUCCESS;
      $runMessage = '';

      try
      {
        $testCase = $this->getInitializedTestCase($test);
        $testCase->test($response, $testSet->getUri());
      }
      catch ( \LiveTest\TestCase\Exception $e )
      {
        $runStatus = Result::STATUS_FAILED;
        $runMessage = $e->getMessage();
      }
      catch ( \Exception $e )
      {
        $runStatus = Result::STATUS_ERROR;
        $runMessage = $e->getMessage();

      }
      $result = new Result($test, $runStatus, $runMessage, $testSet->getUri());
      $this->eventDispatcher->notify('LiveTest.Run.HandleResult',
                                     array('result' => $result,'response' => $response));
    }
  }

  /**
   * This function runs all test sets defined in the properties file.
   *
   * @todo function is "very long" but don't know where to split.
   * @todo why can a preRun listener stop the run?
   *
   * @notify LiveTest.Run.HandleConnectionStatus
   * @notify LiveTest.Run.PostRun
   * @notify LiveTest.Run.PreRun
   */
  public function run()
  {
    $continueRun = $this->eventDispatcher->notify('LiveTest.Run.PreRun', array('properties' => $this->properties));

    if ($continueRun)
    {
      $timer = new Timer();
      $testSets = $this->properties->getTestSets();

      foreach ($testSets as $testSet)
      {
        try
        {
          $this->httpClient->setUri($testSet->getUri()->toString());
          $response = $this->httpClient->request();
          $connectionStatus = new ConnectionStatus(ConnectionStatus::SUCCESS, $testSet->getUri());
          $this->eventDispatcher->notify('LiveTest.Run.HandleConnectionStatus', array('connectionStatus' => $connectionStatus));
        }
        catch ( \Zend_Http_Client_Exception $e )
        {
          $connectionStatus = new ConnectionStatus(ConnectionStatus::ERROR, $testSet->getUri(), $e->getMessage());
          $this->eventDispatcher->notify('LiveTest.Run.HandleConnectionStatus', array('connectionStatus' => $connectionStatus));
          continue;
        }
        $this->runTests($testSet, $response);
      }

      $timer->stop();
      $information = new Information($timer->getElapsedTime(), $this->properties->getDefaultDomain());

      $this->eventDispatcher->notify('LiveTest.Run.PostRun', array('information' => $information));
    }
  }
}