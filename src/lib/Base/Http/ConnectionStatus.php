<?php

namespace Base\Http;

class ConnectionStatus
{
  const SUCCESS = 'success';
  const ERROR = 'error';
  
  private $type;
  private $message;
  
  public function __construct($type, $message = null)
  {
    $this->type = $type;
    $this->message = $message;
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