<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestCase\General\Html;

use Base\Http\Request\Request;
use Base\Www\Html\Document;

use Base\Http\Response\Response;

abstract class TestCase implements \LiveTest\TestCase\TestCase
{
  private $httpResponse;
  private $request;

  /**
   * This function return the Request the test case was tested with
   *
   * @return Request
   */
  public function getRequest()
  {
    return $this->request;
  }

  /**
   * This function is used to create the html document out of the response. It
   * calls the runTest method where all checks shouls be made.
   *
   * @see LiveTest\TestCase.TestCase::test()
   */
  final public function test(Response $httpResponse, Request $request)
  {
    $this->httpResponse = $httpResponse;
    $this->request = $request;

    $htmlDocument = new Document($httpResponse->getBody());
    $this->runTest($htmlDocument);
  }

  /**
   * Returns the http response.
   *
   * @return Response
   */
  protected function getHttpResponse()
  {
    return $this->httpResponse;
  }

  /**
   * This function is called by the run method and is the entry point for all
   * html test cases.
   *
   * @param Document $htmlDocument
   */
  abstract protected function runTest(Document $htmlDocument);
}