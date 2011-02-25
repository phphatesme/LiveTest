<?php
namespace Unit\LiveTest\TestRun\Mockups;

use Base\Http\Response\Response;

class ResponseMockup implements Response
{
  private $status;
  private $body;

  public function __construct($status = '200', $body = 'body')
  {
    $this->status = $status;
    $this->body = $body;
  }

  public function getStatus( )
  {
    return $this->status;
  }

  public function getBody( )
  {
    return $this->body;
  }

  public function getDuration()
  {
    return $this->duration;
  }

  public function setDuration( $duration )
  {
    $this->duration = $duration;
  }
}