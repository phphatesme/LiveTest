<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestCase\General\Html\Dom\XPath;

use LiveTest\ConfigurationException;

use LiveTest\TestCase\Exception as TestCaseException;
use DOMXPath;

/**
 * This testcase checks if the elements that a specified by a xpath have a valid size.
 *
 * @author Nils Langner
 */
class Size extends TestCase
{
  private $xpath;
  private $minSize;
  private $maxSize;
  
  /**
   * Sets the xpath, minSize, maxSize. At least one of the both sizes has to set.
   *
   * @param string $xpath
   * @param int $minSize
   * @param int $maxSize
   * @throws ConfigurationException
   */
  public function init($xpath, $minSize = null, $maxSize = null)
  {
    if (is_null($minSize) && is_null($maxSize))
    {
      throw new ConfigurationException('Neither minSoize nor maxSize is set.');
    }
    
    $this->minSize = $minSize;
    $this->maxSize = $maxSize;
    
    $this->xpath = $xpath;
  }
  
  /**
   * Checks if the elements that a specified by a xpath have a valid size.
   *
   * @see LiveTest\TestCase\General\Html\Dom\XPath.TestCase::doXPathTest()
   *
   * @param DOMXPath $domXPath
   */
  public function doXPathTest(DOMXPath $domXPath)
  {
    $elements = $domXPath->query($this->xpath);
    if ($elements->length == 0)
    {
      throw new TestCaseException('The given xpath ("' . $this->xpath . '") was not found.');
    }
    
    foreach ($elements as $element)
    {
      switch (get_class($element))
      {
        case 'DOMAttr':
          $value = $element->value;
          break;
        case 'DOMNode':
        case 'DOMElement':
          $value = $element->textContent;
      }
      
      $size = strlen($value);
      
      if (!is_null($this->maxSize) && $this->maxSize < $size)
      {
        throw new TestCaseException('The size of the xpath element ("' . $this->xpath . '") is too big (current: ' . $size . ', max: ' . $this->maxSize . ').');
      }
      
      if (!is_null($this->minSize) && $this->minSize > $size)
      {
        throw new TestCaseException('The size of the xpath element ("' . $this->xpath . '") is too small (current: ' . $size . ', min: ' . $this->minSize . ').');
      }
    }
  }
}