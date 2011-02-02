<?php

namespace LiveTest\TestCase\General\Html;

use Base\Www\Html\Document;

use LiveTest\TestCase\Exception;
use LiveTest\TestCase\HtmlTestCase;

class RegExPresent extends HtmlTestCase
{
  protected $mandatoryParameter = array('RegEx');
  
  protected function runTest(Document $htmlDocument)
  {
    $htmlCode = $htmlDocument->getHtml();
    $regEx = $this->getParameter('RegEx');
    
    if (0 == preg_match($regEx, $htmlCode))
    {
      throw new Exception('The given RegEx "' . $this->getParameter('RegEx') . '" was not found.');
    }
  }
}