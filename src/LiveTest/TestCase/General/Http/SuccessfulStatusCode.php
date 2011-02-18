<?php

namespace LiveTest\TestCase\General\Http;

use Base\Www\Uri;
use Base\Http\Response\Response;

use LiveTest\TestCase\TestCase;
use LiveTest\TestCase\Exception;

/**
 * This test case is used to check if the http status is < 400
 *
 * @author Nils Langner
 */
class SuccessfulStatusCode implements TestCase
{
  /**
   * This function checks if the status code is < 400
   *
   * @see LiveTest\TestCase.HttpTestCase::test()
   */
  public function test(Response $response, Uri $uri)
  {
    $status = (int)$response->getStatus();
    if ($status >= 400 )
    {
      throw new Exception('The http status code ' . $status . ' was found (<400 expected).');
    }
  }
}