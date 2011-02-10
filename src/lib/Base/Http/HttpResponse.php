<?php
namespace Base\Http;

interface HttpResponse
{
  public function __construct( \Zend_Http_Response $response );
  public function getStatus( );
  public function getBody( );
}