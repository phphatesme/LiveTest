<?php

namespace LiveTest\TestRun\Result;

class ResultSet
{
  private $results = array();
  
  private $status;
  
  public function __construct()
  {
    $this->status = Result::STATUS_SUCCESS;
  }
  
  public function addResult(Result $result)
  {
    $this->status = max($result->getStatus(), $this->status);
    $this->results[] = $result;
  }
  
  public function getStatus()
  {
    return $this->status;
  }
  
  public function getResultCount()
  {
    return count($this->results);
  }
  
  public function getResults()
  {
    return $this->results;
  }

} 