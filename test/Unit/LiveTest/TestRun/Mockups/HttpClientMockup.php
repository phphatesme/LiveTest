<?php
namespace Unit\LiveTest\TestRun\Mockups;

use Base\Http\Response\Zend;

use Base\Http\Response\Response;
use Base\Http\Client\Client;

class HttpClientMockup implements Client
{

  private $response;
  private $uri;

  public function __construct(Response $response)
  {
    $this->response = $response;
  }

  public function request($method = null)
  {
    return $this->response;
  }

  public function setUri($uri)
  {
    $this->uri = $uri;
  }
}