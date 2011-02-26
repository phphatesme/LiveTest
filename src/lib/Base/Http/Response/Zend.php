<?php

namespace Base\Http\Response;

/**
 * @author mikelohmann
 *
 */
class Zend implements Response
{
  private $duration;
  private $zendResponse;

  /**
   * @todo read Type for $response....(after discussion) :)
   * @param unknown_type $response
   */
  public function __construct(\Zend_Http_Response $response, $duration)
  {
    $this->duration = $duration;
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

  public function getDuration( )
  {
    return $this->duration;
  }

  public function getHeader($header)
  {
  	return $this->zendResponse->getHeader($header);
  }

  public function getHeaders()
  {
		return $this->zendResponse->getHeaders();
  }
}