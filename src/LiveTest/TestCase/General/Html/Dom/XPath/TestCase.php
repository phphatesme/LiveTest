<?php

namespace LiveTest\TestCase\General\Html\Dom\XPath;

use LiveTest\TestCase\Exception;

use DOMDocument, DOMXPath;

abstract class TestCase extends \LiveTest\TestCase\General\Html\Dom\TestCase
{
  private $xpath;

  public function init($xpath)
  {
    $this->xpath = $xpath;
  }

  final protected function doDomTest(DOMDocument $domDocument)
  {
    $xpath = new DOMXPath($domDocument);

    $this->doXPathTest($xpath);
  }

  abstract protected function doXPathTest(DOMXPath $domXPath);
}