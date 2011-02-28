<?php

namespace Unit\Base\Http\Response;

use Base\Http\Response\Response;

class MockUp implements Response
{
  private $body = '';
  private $duration = 0;
  private $headers = array();
  private $status = 200;

  public function setBody($body)
  {
    $this->body = $body;
  }

  public function setDuration($duration)
  {
    $this->duration = $duration;
  }

  public function setHeaders($headers)
  {
    $this->headers = $headers;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  public function getBody()
  {
    return $this->body;
  }

  public function getDuration()
  {
    return $this->duration;
  }

  public function getHeader($header)
  {
    return $this->headers[$header];
  }

  public function getHeaders()
  {
    return $this->headers();
  }

  public function getStatus()
  {
    return $this->status;
  }
}