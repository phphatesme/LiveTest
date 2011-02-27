<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestCase\General\Html;

use Base\Www\Html\Document;

use LiveTest\TestCase\Exception;

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
class XPath extends TestCase
{
  /**
   * The xPath epresseion to select to content.
   * @var string
   */
  private $xPath;

  /**
   * The regex pattern which must match all xPath results.
   * @var string
   */
  private $regEx;

  /**
   * Initialize this test case (load configuration settings).
   *
   * @param string $xPath The xPath epresseion to select to content
   * @param string $regEx The regex pattern which must match all xPath results
   */
  public function init($xPath, $regEx)
  {
    $this->xPath = $xPath;
    $this->regEx = $regEx;
  }


  /**
   * Checks whether the regEx matches all results of the xPath
   * query on the given DOMDocument.
   *
   * @param DOMDocument $doc the DOMDocument
   * @return bool true if all occurrences match, false otherwise
   */
  private function matchXPath(\DOMDocument $doc)
  {
    $domXPath = new \DOMXPath($doc);
    $elements = @$domXPath->query($this->xPath);
    if (false === $elements)
    {
      // @todo use configuration Exception?!
      throw new Exception('Invalid XPath "' . $this->xPath . '" in configuration');
    }

    // no matching xPath value found
    if (0 === $elements->length)
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
      if (0 === preg_match($this->regEx, $value))
      {
        return false;
      }
    }

    return true;
  }

  /**
   * Executes the test case
   *
   * @param Base\Www\Html\Document $htmlDocument the document to inspect
   *
   * @throws LiveTest\TestCase\Exception on failed tests
   */
  protected function runTest(Document $htmlDocument)
  {
    $htmlCode = $htmlDocument->getHtml();

    $doc = new \DOMDocument();
    if (!@$doc->loadHTML($htmlCode))
    {
      throw new Exception('Can\'t create DOMDocument from HTML');
    }

    if (!$this->matchXPath($doc))
    {
      throw new Exception('The result of the given XPath "' . $this->xPath .
           '" doesn\'t match the RegEx "' . $this->regEx . '"');
    }
  }
}
