<?php

namespace LiveTest\TestCase\General\Html;

use Base\Www\Uri;
use Base\Www\Html\Document;

use Base\Http\Response\Response;

abstract class TestCase implements \LiveTest\TestCase\TestCase
{
  private $httpResponse;
  private $uri;

  /**
   * This function return the uri the test case was tested with
   *
   * @return Uri
   */
  public function getUri()
  {
    return $this->uri;
  }

  /**
   * This function is used to create the html document out of the response. It
   * calls the runTest method where all chckes shouls be made.
   *
   * @see LiveTest\TestCase.TestCase::test()
   */
  final public function test(Response $httpResponse, Uri $uri)
  {
    $this->httpResponse = $httpResponse;
    $this->uri = $uri;

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