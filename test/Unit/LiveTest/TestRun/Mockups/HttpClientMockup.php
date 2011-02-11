<?php
namespace Unit\LiveTest\TestRun\Mockups;

use Base\Http\HttpResponse;
use Base\Http\HttpClient;
use Base\Http\Response;

class HttpClientMockup implements HttpClient
{
  
  private $response;
  private $uri;
  
  public function __construct(HttpResponse $response)
  {
    $this->response = $response;
  }
  
  public function request($method = null)
  {
    return new Response( $this->response );
  }
  
  public function setUri($uri)
  {
    $this->uri = $uri;
  }
}