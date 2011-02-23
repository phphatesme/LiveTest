<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun\Result;

use Base\Www\Uri;

use LiveTest\TestRun\Test;

class Result
{
  const STATUS_SUCCESS = 'success';
  const STATUS_FAILED = 'failure';
  const STATUS_ERROR = 'error';

  private $test;
  private $status;
  private $message;
  private $uri;

  public function __construct(Test $test, $status, $message, Uri $uri)
  {
    $this->test = $test;
    $this->status = $status;
    $this->message = $message;
    $this->uri = $uri;
  }

  public function getTest()
  {
    return $this->test;
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
}
