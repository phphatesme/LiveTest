<?php

namespace LiveTest\TestCase\General\Http;

use LiveTest\TestCase\TestCase;
use LiveTest\TestCase\Exception;

use Base\Www\Uri;
use Base\Http\Response\Response;

/**
 * This test case is used to check for an speficed http status code.
 *
 * @author Nils Langner
 */
class ExpectedStatusCode implements TestCase
{
  private $statusCode;

  /**
   * Sets the http status code

   * @param int $statusCode
   */
  public function init($statusCode)
  {
    $this->statusCode = $statusCode;
  }

  /**
   * Checks if the actual http status equals the expected.
   *
   * @see LiveTest\TestCase.HttpTestCase::test()
   */
  public function test(Response $response, Uri $uri)
  {
    $status = $response->getStatus();
    if ($status != $this->statusCode)
    {
      throw new Exception('The http status code ' . $status . ' was found, expected code was ' . $this->statusCode);
    }
  }
}