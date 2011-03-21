<?php

namespace LiveTest\TestCase\General\Html\Dom;

use Base\Www\Uri;
use Base\Http\Response\Response;

use DOMDocument;

abstract class TestCase implements \LiveTest\TestCase\TestCase
{
  final public function test(Response $response, Uri $uri)
  {
    $doc = new DOMDocument();
    if (!@$doc->loadHTML($response->getBody()))
    {
      throw new \Exception("Can't create DOMDocument from HTML");
    }
    $this->doDomTest($doc);
  }

  abstract protected function doDomTest(DOMDocument $domDocument);
}