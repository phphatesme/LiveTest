<?php

namespace LiveTest\TestCase;

use Base\Www\Uri;

use Base\Http\Response;
use Base\Http\Client;

abstract class HttpTestCase extends ConfigurableTestCase
{
  protected $mandatoryParameter = array();
    
  public function test(Response $httpResponse, Uri $uri)
  {
    $this->runTest($httpResponse);
  }

  abstract protected function runTest(Response $httpClient);
}