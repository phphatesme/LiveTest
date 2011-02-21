<?php

namespace LiveTest\TestCase\General\Html;

use Base\Www\Html\Document;
use LiveTest\TestCase\Exception;

/**
 * This text case is used to check if a given text is not present.
 *
 * @author Nils Langner
 */
class TextNotPresent extends TestCase
{
  private $text;

  /**
   * This function initializes the text to search for.
   *
   * @param string $text
   */
  public function init($text)
  {
    $this->text = $text;
  }

  /**
   * Checks if a givent string is not found.
   *
   * @see LiveTest\TestCase.HtmlTestCase::runTest()
   */
  protected function runTest(Document $htmlDocument)
  {
    $htmlCode = $htmlDocument->getHtml();
    if (strpos($htmlCode, $this->text) !== false)
    {
      throw new Exception('The given text "' . $this->text . '" was found.');
    }
  }
}