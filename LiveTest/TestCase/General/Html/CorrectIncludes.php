<?php

namespace LiveTest\TestCase\General\Html;

use Base\Www\Html\Document;

use LiveTest\TestCase\Exception;
use LiveTest\TestCase\HtmlTestCase;

class CorrectIncludes extends HtmlTestCase
{
  protected function runTest(Document $htmlDocument)
  {
    $externalUrls = $htmlDocument->getExternalDependencies($this->getUri()->toString());
    
    foreach ($externalUrls as $url)
    {
      $client = new \Zend_Http_Client($url);
      $client->request();
    }
  }
}