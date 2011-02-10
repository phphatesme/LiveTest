<?php

namespace Base\Http;

class Response
{
  /**
   * @var \Base\Http\Response
   */
  private $Response;
  
  public function __construct(\Base\Http\Response $response)
  {
    $this->Response = $response;
  }
  
  public function getStatus( )
  {
    return $this->Response->getStatus( );
  }
  
  public function getBody( )
  {
    return $this->Response->getBody();
  }
}