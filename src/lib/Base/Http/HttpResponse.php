<?php
namespace Base\Http;

interface HttpResponse
{
  public function getStatus( );
  public function getBody( );
}