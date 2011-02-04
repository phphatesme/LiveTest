<?php

// @todo muss sauber implementiert werde. so gibt es kein autocompletion.
namespace Base\Http;

class Response
{
  private $zendResponse;
  
  public function __construct(\Zend_Http_Response $response)
  {
    $this->zendResponse = $response;
  }
  
  public function __call($method, $args)
  {
    return call_user_func_array(array($this->zendResponse,$method), $args);
  }
}