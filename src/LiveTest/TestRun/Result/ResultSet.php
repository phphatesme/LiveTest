<?php

namespace LiveTest\TestRun\Result;

class ResultSet
{
  private $results = array();

  private $status;
  private $statusWeight = array( );

  public function __construct()
  {
    $this->statusWeight = array( Result::STATUS_SUCCESS => 0,
                                 Result::STATUS_FAILED => 1,
                                 Result::STATUS_ERROR => 2 );

    $this->status = $this->statusWeight[Result::STATUS_SUCCESS];
  }

  public function addResult(Result $result)
  {
    $this->status = max($this->statusWeight[$result->getStatus()], $this->status);
    $this->results[] = $result;
  }

  public function getStatus()
  {
    foreach($this->statusWeight as $key => $value )
    {
      if ($value == $this->status) {
        return $key;
      }
    }
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