<?php

namespace Base\Http\Client;

use Base\Timer\Timer;
use Zend\Http\Client as ZendClient;

class Zend extends ZendClient implements Client
{
  public function request($method = null)
  {
    $timer = new Timer();
    $response = parent::request($method);
    return new \Base\Http\Response\Zend($response, $timer->stop());
  }

  public function setTimeout($timeInSeconds)
  {
    $this->setConfig(array('timeout' => $timeInSeconds));
  }
}