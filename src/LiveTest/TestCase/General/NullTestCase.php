<?php

namespace LiveTest\TestCase\General;

use Base\Http\Request\Request;
use Base\Http\Response\Response;

use LiveTest\TestCase\TestCase;

/**
 * @author Nils Langner
 */
class NullTestCase implements TestCase
{
  /**
   * @see LiveTest\TestCase.HttpTestCase::test()
   */
  public function test(Response $response, Request $request)
  {
  }
}