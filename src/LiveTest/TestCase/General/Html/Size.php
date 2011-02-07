<?php

namespace LiveTest\TestCase\General\Html;

use Base\Www\Html\Document;

use LiveTest\TestCase\Exception;
use LiveTest\TestCase\HtmlTestCase;

class Size extends HtmlTestCase
{
  protected function runTest(Document $htmlDocument)
  {
    $size = strlen($htmlDocument->getHtml());
    
    if ($this->hasParameter('min_size'))
    {
      if ($this->getParameter('min_size') >= $size)
      {
        throw new Exception('The given document is too small (expected min size: ' . $this->getParameter('min_size') . '; actual size: ' . $size . ')');
      }
    }
    
    if ($this->hasParameter('max_size'))
    {
      if ($this->getParameter('max_size') <= $size)
      {
        throw new Exception('The given document is too big (expected max size: ' . $this->getParameter('max_size') . '; actual size: ' . $size . ')');
      }
    }
    
    if (!$this->hasParameter('max_size') && !$this->hasParameter('min_size'))
    {
      throw new \LiveTest\Exception('Configuration error: min_size nor max_size where set.');
    }
  }
}