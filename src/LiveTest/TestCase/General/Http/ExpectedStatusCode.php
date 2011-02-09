<?php

namespace LiveTest\TestCase\General\Http;

use LiveTest\TestCase\Exception;

use LiveTest\TestCase\HttpTestCase;
use Base\Http\Response;

class ExpectedStatusCode extends HttpTestCase
{
  protected $mandatoryParameter = array('StatusCode');
  
  protected function runTest(Response $httpClient)
  {
    $status = $httpClient->getStatus();
    if ($status != $this->getParameter('StatusCode'))
    {
      throw new Exception('The http status code ' . $status . ' was found, expected code was ' . $this->getParameter('StatusCode'));
    }
  }
}