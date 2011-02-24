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
 * This text case is used to check if a text string exists in a given html document.

 * @author Nils Langner
 */
class TextPresent extends TestCase
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
   * This function checks for a string to occur.
   *
   * @see LiveTest\TestCase\General\Html.TestCase::runTest()
   *
   * @throws Exception
   */
  protected function runTest(Document $htmlDocument)
  {
    $htmlCode = $htmlDocument->getHtml();

    if (strpos($htmlCode, $this->text) === false)
    {
      throw new Exception('The given text "' . $this->text . '" was not found.');
    }
  }
}