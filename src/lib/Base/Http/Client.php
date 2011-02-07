<?php

namespace Base\Http;

class Client extends \Zend_Http_Client
{
  public function request($method = null)
  {
    $response = parent::request($method);
    return new Response($response);
  }
}