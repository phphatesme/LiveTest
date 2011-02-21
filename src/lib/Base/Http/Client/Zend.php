<?php

namespace Base\Http\Client;

class Zend extends \Zend_Http_Client implements Client
{
  public function request($method = null)
  {
    $response = parent::request( $method );
    return new \Base\Http\Response\Zend($response);
  }
}
