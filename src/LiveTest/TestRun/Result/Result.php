<?php

namespace LiveTest\TestRun\Result;

use Base\Www\Uri;

use LiveTest\TestRun\Test;

class Result
{
  const STATUS_SUCCESS = 'success';
  const STATUS_FAILED = 'failure';
  const STATUS_ERROR = 'error';

  private $status;
  private $message;
  private $uri;
  private $test;

  public function __construct(Test $test, $status, $message, Uri $uri)
  {
    $this->status = $status;
    $this->message = $message;
    $this->uri = $uri;
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

  public function getUri()
  {
    return $this->uri;
  }

  public function getTest()
  {
    return $this->test;
  }
}