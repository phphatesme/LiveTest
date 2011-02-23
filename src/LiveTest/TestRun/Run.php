<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun;

use LiveTest\TestCase\Exception;
use LiveTest\TestRun\Result\Result;

use Annovent\Event\Dispatcher;

use Base\Http\Client\Client;
use Base\Http\ConnectionStatus;
use Base\Http\Response\Response;
use Base\Www\Uri;
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
    \LiveTest\initializeObject($testCaseObject, $test->getParameter());

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
                                     array('result' => $result, 'response' => $response));
    }
  }

  /**
   * This function sends a http request and assigns the response to the test cases.
   *
   * @notify LiveTest.Run.HandleConnectionStatus
   *
   * @param TestSet $testSet
   */
  private function runTestSet(TestSet $testSet)
  {
    $connectionStatusValue = ConnectionStatus::SUCCESS;
    $connectionStatusMessage = '';

    try
    {
      $this->httpClient->setUri($testSet->getUri()->toString());
      $response = $this->httpClient->request();
    }
    catch ( \Zend_Http_Client_Exception $e )
    {
      $connectionStatusValue = ConnectionStatus::ERROR;
      $connectionStatusMessage = $e->getMessage();
    }

    $connectionStatus = new ConnectionStatus($connectionStatusValue, $testSet->getUri(), $connectionStatusMessage);

    $this->eventDispatcher->notify('LiveTest.Run.HandleConnectionStatus',
                                   array('connectionStatus' => $connectionStatus));

    if( $connectionStatusValue == ConnectionStatus::SUCCESS )
    {
      $this->runTests($testSet, $response);
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
    $this->eventDispatcher->notify('LiveTest.Run.PreRun', array('properties' => $this->properties));

    // @todo move timer to runner.php
    $timer = new Timer();

    foreach ($this->properties->getTestSets() as $testSet)
    {
      $this->runTestSet($testSet);
    }

    $information = new Information($timer->stop(), $this->properties->getDefaultDomain());

    $this->eventDispatcher->notify('LiveTest.Run.PostRun', array('information' => $information));
  }
}