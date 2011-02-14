<?php

namespace Base\Http;
use Base\Http\HttpResponse;

/**
 * 
 * @todo this is not really logical. Lets discuss if a response is of Type HttpResponse and
 * extends ZendResponse.
 * @author mikelohmann
 *
 */
class Response implements HttpResponse
{
  /**
   * @todo readd Type for $response....(after discussion) :)
   * @param unknown_type $response
   */
  public function __construct($response)
  {
    $this->zendResponse = $response;
  }
  
  public function getStatus( )
  {
    return $this->zendResponse->getStatus();
  }
  
  public function getBody( )
  {
    return $this->zendResponse->getBody();
  }
}