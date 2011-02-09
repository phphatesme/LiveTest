<?php

namespace LiveTest\TestCase\General\Http;

use LiveTest\TestCase\Exception;

use LiveTest\TestCase\HttpTestCase;
use Base\Http\Response;

class SuccessfulStatusCode extends HttpTestCase
{
  protected function runTest(Response $httpClient)
  {
    $status = (int)$httpClient->getStatus();
    if ($status >= 400 )
    {
      throw new Exception('The http status code ' . $status . ' was found (<400 expected).');
    }
  }
}