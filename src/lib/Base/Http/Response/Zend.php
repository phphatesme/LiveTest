<?php

namespace Base\Http\Response;

/**
 * @author mikelohmann
 *
 */
class Zend implements Response
{
  /**
   * @todo readd Type for $response....(after discussion) :)
   * @param unknown_type $response
   */
  public function __construct(\Zend_Http_Response $response)
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