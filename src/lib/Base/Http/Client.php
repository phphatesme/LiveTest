<?php

namespace Base\Http;

class Client extends \Zend_Http_Client implements HttpClient
{
  public function request($method = null)
  {
    $response = parent::request($method);
    return new Response($response);
  }
}