<?php

namespace LiveTest\TestCase\General\Html;

use Base\Www\Html\Document;

use LiveTest\TestCase\Exception;
use LiveTest\TestCase\HtmlTestCase;


/**
 * XPath testcase
 * 
 * This test case allows to select contents from the HTML document
 * by an XPath expression and match these contents against a given
 * regular expression.
 *
 * If the XPath returns multiple content elements, every single element
 * has to match the regular expression, otherwise the test fails.
 *
 * If the XPath doesn't match at all this is also regarded as a test
 * failure.
 */
class XPath extends HtmlTestCase
{
  protected $mandatoryParameter = array('XPath', 'RegEx');


  /**
   * XXX call this function multiple times with different xPaths
   * on the same document
   * => a more complex testcase configuration is needed for this
   */
  private function matchXPath(\DOMDocument $doc, $xPath, $regEx)
  {
    $domXPath = new \DOMXPath($doc);
    $elements = $domXPath->query($xPath);
    if (false === $elements)
    {
      // XXX configuration Exception?!
      throw new Exception('Invalid XPath "' . $xPath .'" in configuration');
    }

    // no matching xPath value found
    if (empty($elements))
    {
      return false;
    }

    foreach ($elements as $element)
    {
      $value = '';

      // depending on the xPath query we may be provided with different
      // result objects
      switch (get_class($element))
      {
        case 'DOMAttr':
          $value = $element->value;
          break;
        case 'DOMNode':
        case 'DOMElement':
          $value = $element->textContent;
      }

      // if a result doesn't match the given regular expression the test fails
      if (0 === preg_match($regEx, $value))
      {
        return false;
      }
    }

    return true;
  }
  
  protected function runTest(Document $htmlDocument)
  {
    $htmlCode = $htmlDocument->getHtml();

    $doc = new \DOMDocument();
    if (!@$doc->loadHTML($htmlCode))
    {
      throw new Exception('Can\'t create DOMDocument from HTML');
    }

    $xPath = $this->getParameter('XPath');
    $regEx = $this->getParameter('RegEx');
    if (!$this->matchXPath($doc, $xPath, $regEx))
    {
      throw new Exception('The result of the given XPath "' . $xPath .
          '" doesn\'t match the RegEx "' . $regEx . '"');
    }
  }
}
