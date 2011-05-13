<?php

namespace LiveTest\TestRun;

use Base\Http\Client\Client;

class TestSession
{
  private $testSets = array ();
  private $client;
  
  public function __construct(Client $client)
  {
  	$this->client = $client;
  }
  
  public function getClient( )
  {
  	return $this->client;
  }
  
  public function addTestSet(TestSet $testSet)
  {
    $this->testSets[] = $testSet;
  }
  
  public function getTestSets()
  {
    return $this->testSets;
  }
}