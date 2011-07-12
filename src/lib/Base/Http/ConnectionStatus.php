<?php

namespace Base\Http;

use Base\Http\Response\Response;

use Base\Http\Request\Request;

class ConnectionStatus
{
  const SUCCESS = 'success';
  const ERROR = 'error';

  private $type;
  private $message;
  private $request;
  private $response;

  public function __construct($type, Request $request, $message = null)
  {
    $this->type = $type;
    $this->message = $message;
    $this->request = $request;
  }

  public function setResponse(Response $response)
  {
    $this->response = $response;
  }

  public function getResponse()
  {
    return $this->response;
  }

  public function getRequest()
  {
    return $this->request;
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