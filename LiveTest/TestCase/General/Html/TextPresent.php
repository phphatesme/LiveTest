<?php

namespace LiveTest\TestCase\General\Html;

use Base\Www\Html\Document;

use LiveTest\TestCase\Exception;
use LiveTest\TestCase\HtmlTestCase;

class TextPresent extends HtmlTestCase
{
  protected $mandatoryParameter = array('Text');
  
  protected function runTest(Document $htmlDocument)
  {
    $htmlCode = $htmlDocument->getHtml();
    if (strpos($htmlCode, $this->getParameter('Text')) === false)
    {
      throw new Exception('The given text "' . $this->getParameter('Text') . '" was not found.');
    }
  }
}