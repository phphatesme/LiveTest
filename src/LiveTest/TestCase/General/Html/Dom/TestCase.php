<?php

namespace LiveTest\TestCase\General\Html\Dom;

use LiveTest\Config\Request\Request;
use Base\Http\Response\Response;

use DOMDocument;

abstract class TestCase implements \LiveTest\TestCase\TestCase
{
  final public function test(Response $response, Request $request)
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