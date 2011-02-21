<<<<<<< HEAD:src/LiveTest/TestRun/Run.php
<?php

namespace LiveTest\TestRun;

use Base\Http\Client\Client;

use LiveTest\Listener\ProgressBar;

use Annovent\Event\Event;
use Annovent\Event\Dispatcher;

use Base\Timer\Timer;

use Base\Http\ConnectionStatus;

use Base\Www\Uri;

use LiveTest\Extensions\Extension;
use LiveTest\TestCase\Exception;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

use Base\Http\Response\Response;

class Run
{
  /**
   * All properties for the test run
   *
   * @var LiveTest\TestRun\Properties
   */
  private $properties;
  private $httpClient = null;
  private $eventDispatcher;

  public function __construct(Properties $properties, Client $httpClient, Dispatcher $dispatcher)
  {
    $this->eventDispatcher = $dispatcher;
    $this->httpClient = $httpClient;
    $this->properties = $properties;
  }

  private function runTests(TestSet $testSet, Response $response)
  {
    foreach ($testSet->getTests() as $test)
    {
      $testCaseName = $test->getClassName();
      try
      {
        $testCaseObject = new $testCaseName();
        \LiveTest\initializeObject($testCaseObject, $test->getParameter()->toArray());
        $testCaseObject->test($response, new Uri($testSet->getUrl()));
        $result = new Result($test, Result::STATUS_SUCCESS, '', new Uri($testSet->getUrl()));
      }
      catch ( \LiveTest\TestCase\Exception $e )
      {
        $result = new Result($test, Result::STATUS_FAILED, $e->getMessage(), new Uri($testSet->getUrl()));
      }
      catch (\Exception $e )
      {
        $result = new Result($test, Result::STATUS_ERROR, $e->getMessage(), new Uri($testSet->getUrl()));
      }
      $this->eventDispatcher->notify('LiveTest.Run.HandleResult', array( 'result' => $result, 'response' => $response ));
    }
  }

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
          $this->httpClient->setUri($testSet->getUrl());
          $response = $this->httpClient->request();
          $connectionStatus = new ConnectionStatus(ConnectionStatus::SUCCESS, new Uri($testSet->getUrl()));
          $this->eventDispatcher->notify('LiveTest.Run.HandleConnectionStatus', array( 'connectionStatus' => $connectionStatus ));
        }
        catch ( \Zend_Http_Client_Exception $e )
        {
          $connectionStatus = new ConnectionStatus(ConnectionStatus::ERROR, new Uri($testSet->getUrl()), $e->getMessage());
          $this->eventDispatcher->notify('LiveTest.Run.HandleConnectionStatus', array( 'connectionStatus' => $connectionStatus ));
          continue;
        }
        $this->runTests($testSet, $response);
      }

      $timer->stop();
      $information = new Information($timer->getElapsedTime(), $this->properties->getDefaultDomain());

      $this->eventDispatcher->notify('LiveTest.Run.PostRun', array( 'information' => $information ));
    }
  }
}
