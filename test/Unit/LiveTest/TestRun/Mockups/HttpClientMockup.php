<?php
namespace Unit\LiveTest\TestRun\Mockups;

use Base\Http\Response\Zend;

use Base\Http\Response\Response;
use Base\Http\Client\Client;

class HttpClientMockup implements Client
{

  private $response;
  private $uri;
  private $nextRequestFails = false;

  public function __construct(Response $response)
  {
    $this->response = $response;
  }

  public function nextRequestFails()
  {
    $this->nextRequestFails = true;
  }

  public function request($method = null)
  {
    if ($this->nextRequestFails)
    {
      $this->nextRequestFails = false;
      throw new \Zend_Http_Client_Exception('TestException');
    }
    return $this->response;
  }

  public function setUri($uri)
  {
    $this->uri = $uri;
  }
}