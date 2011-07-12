<?php

namespace Base\Http\Client;

use Base\Http\Request\Request;

use Base\Timer\Timer;
use Zend\Http\Client as ZendClient;

class Zend extends ZendClient implements Client
{
  public function request(Request $request)
  {
    $method = $request->getMethod();

    $parameters = $request->getParameters();

    $this->setUri($request->getUri());

    if (!strcasecmp($method, Request::GET))
    {
      $this->setParameterGet($parameters);
    }
    else if (!strcasecmp($method, Request::POST))
    {
      $this->setParameterPost($parameters);
    }

    $timer = new Timer();
    $response = parent::request($method);
    $duration = $timer->stop();
    return new \Base\Http\Response\Zend($response, $duration);
  }

  public function setTimeout($timeInSeconds)
  {
    $this->setConfig(array ('timeout' => $timeInSeconds));
  }
}