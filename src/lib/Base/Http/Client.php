<?php

namespace Base\Http;

class Client extends \Zend_Http_Client implements HttpClient
{
  public function request($method = null)
  {
    $response = parent::request( $method );
var_dump( get_class($response) );  
  return new Response( $response );
  }
}
