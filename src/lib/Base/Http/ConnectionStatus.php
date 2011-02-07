<?php

namespace Base\Http;

use Base\Www\Uri;

class ConnectionStatus
{
  const SUCCESS = 'success';
  const ERROR = 'error';
  
  private $type;
  private $message;
  private $uri;
  
  public function __construct($type, Uri $uri, $message = null)
  {
    $this->type = $type;
    $this->message = $message;
    $this->uri = $uri;
  }

  public function getUri( )
  {
    return $this->uri;
  }
  
  public function getType()
  {
    return $this->type;
  }

  public function getMessage()
  {
    return $this->message;
  }
}