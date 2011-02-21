<?php

namespace LiveTest\TestCase;

use Base\Www\Uri;
use Base\Http\Response\Response;

interface TestCase
{
  /**
   * This function runs the test case. If a test fails a LiveTest\TestCase\Exception has to be
   * thrown. The idea was adapted from the PHPUnit concept.
   *
   * @param Base\Http\Response $httpResponse
   * @param Base\Www\Uri $uri
   */
  public function test(Response $response, Uri $uri);
}