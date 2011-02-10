<?php

namespace Base\Http;

class Response implements HttpResponse
{
  public function __construct(\Zend_Http_Response $response)
  {
    $this->zendResponse = $response;
  }
  
  public function getStatus( )
  {
    return $this->zendResponse->getStatus( );
  }
  
  public function getBody( )
  {
    return $this->zendResponse->getBody();
  }
}