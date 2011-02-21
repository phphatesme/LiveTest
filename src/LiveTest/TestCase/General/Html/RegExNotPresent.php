<?php

namespace LiveTest\TestCase\General\Html;

use Base\Www\Html\Document;
use LiveTest\TestCase\Exception;

/**
 * This test case is used to check the non-existence of are given regular expression.
 *
 * @author Nils Langner
 */
class RegExNotPresent extends TestCase
{
  private $regEx;
  
  /**
   * This function initializes the regular expression to check against.
   * 
   * @param string $regEx
   */
  public function init($regEx)
  {
    $this->regEx = $regEx;
  }
  
  /**
   * This function checks if the regEx is not found in the html document. 
   * 
   * @see LiveTest\TestCase\General\Html.TestCase::runTest()
   */
  protected function runTest(Document $htmlDocument)
  {
    $htmlCode = $htmlDocument->getHtml();
    
    if (1 == preg_match($this->regEx, $htmlCode))
    {
      throw new Exception('The given RegEx "' . $this->regEx . '" was found.');
    }
  }
}