<?php

namespace LiveTest\TestRun;

use Base\Www\Uri;

use LiveTest\Extensions\Extension;
use LiveTest\TestCase\Exception;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

use Base\Http\Response;
use Base\Http\Client;

class Run
{
  /**
   * All properties for the test run
   * 
   * @var LiveTest\TestRun\Properties
   */
  private $properties;
  
  private $extensions = array();
  
  public function addExtension(Extension $extension)
  {
    $this->extensions[] = $extension;
  }
  
  public function __construct(Properties $properties)
  {
    $this->properties = $properties;
  }
  
  private function extensionsPostRun()
  {
    foreach ($this->extensions as $extension)
    {
      $extension->postRun();
    }
  }
  
  private function handleResult(Result $result, Test $test,\Zend_Http_Response $response)
  {
    foreach ($this->extensions as $extension)
    {
      $extension->handleResult($result, $test, $response);
    }
  }
  
  private function extensionsPreRun()
  {
    foreach( $this->extensions as $extension ) 
    {
      $extension->preRun($this->properties);
    }
  }
  
  public function run()
  { 
    $this->extensionsPreRun();       
    $testSets = $this->properties->getTestSets();
    foreach ($testSets as $testSet)
    {
      $client = new \Zend_Http_Client($testSet->getUrl());
      $response = $client->request();
      foreach ($testSet->getTests() as $test)
      {
        $testCaseName = $test->getClass();
        try
        {
          $testCaseObject = new $testCaseName($test->getParameter());
          $testCaseObject->test($response, new Uri($testSet->getUrl()));
          $result = new Result($test, Result::STATUS_SUCCESS, '', $testSet->getUrl());
        }
        catch ( \LiveTest\TestCase\Exception $e )
        {
          $result = new Result($test, Result::STATUS_FAILED, $e->getMessage(), $testSet->getUrl());
        }
        catch ( Exception $e )
        {
          $result = new Result($test, Result::STATUS_ERROR, $e->getMessage(), $testSet->getUrl());
        }
        $this->handleResult($result, $test, $response);
      }
    }
    $this->extensionsPostRun();
  }
}