<?php

namespace LiveTest\TestRun\Result;

use LiveTest\TestRun\Test;

class Result
{
  const STATUS_SUCCESS = '1';
  const STATUS_FAILED = '2';
  const STATUS_ERROR = '3';
  
  private $status;
  private $message;
  private $url;
  private $test;
  
  
  public function __construct(Test $test, $status, $message, $url)
  {
    $this->status = $status;
    $this->message = $message;
    $this->url = $url;
    $this->test = $test;
  }
  
  public function getStatus()
  {
    return $this->status;
  }
  
  public function getMessage()
  {
    return $this->message;
  }
  
  public function getUrl()
  {
    return $this->url;
  }
  
  public function getTest()
  {
    return $this->test;
  }
}