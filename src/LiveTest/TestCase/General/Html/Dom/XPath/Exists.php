<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestCase\General\Html\Dom\XPath;

use LiveTest\ConfigurationException;
use LiveTest\InvalidArgumentException;
use LiveTest\TestCase\General\Html\Dom\XPath\Exception;
use DOMXPath;

/**
 * This test case checks if a given (or more) xpath is existing.
 *
 * @example
 * Xpaths:
 *  TestCase: LiveTest\TestCase\General\Html\Dom\XPath\Exists
 *  Parameter:
 *  xpaths:
 *   - /html
 *   - /html/body
 *
 * Xpath:
 *  TestCase: LiveTest\TestCase\General\Html\Dom\XPath\Exists
 *  Parameter:
 *  xpaths: /html
 *
 * @author Nils Langner
 */
class Exists extends TestCase
{
  private $xpaths;

  /**
   * Sets the xpaths to be checked
   *
   * @see LiveTest\TestCase\General\Html\Dom\XPath.TestCase::init()
   * @throws LiveTest\ConfigurationException
   *
   * @param $xpath
   * @param $xpaths
   */
  public function init($xpath = null, $xpaths = null)
  {
    $this->xpath = $xpath;

    if (!is_null($xpath))
    {
      if (is_array($xpath))
      {
      	throw new InvalidArgumentException('The xpath parameter must be a string.', 'xpath', null, null);
      }
      $this->xpaths = array($xpath);
    }
    elseif (!is_null($xpaths))
    {
      if (!is_array($xpaths))
      {
        throw new InvalidArgumentException('The xpaths parameter must be an array', 'xpaths', null, null);
      }
      $this->xpaths = $xpaths;
    }
    else
    {
      throw new ConfigurationException('Neither xpath nor xpaths parameter is set.');
    }
  }

  /**
   * This function checks if the given xpaths are existing.
   *
   * @see LiveTest\TestCase\General\Html\Dom\XPath.TestCase::doXPathTest()
   * @throws LiveTest\TestCase\Exception
   *
   * @param DOMXPath $domXPath
   */
  protected function doXPathTest(DOMXPath $domXPath)
  {
    foreach ($this->xpaths as $xpath)
    {
      $elements = $domXPath->query($xpath);
      if ($elements->length == 0)
      {
        throw new Exception('The given xpath ("' . $xpath . '") was not found.', $xpath);
      }
    }
  }
}