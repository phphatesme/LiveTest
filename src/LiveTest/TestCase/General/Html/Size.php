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
use LiveTest\TestCase\HtmlTestCase;

/**
 * This test case is used to check if the size of the html document (number of chars) is in between
 * a given range.

 * @author Nils Langner
 */
class Size extends TestCase
{
  private $minSize;
  private $maxSize;

  /**
   * Initializes the min and max size. Throws an exception when none of the two parameters
   * are set.
   *
   * @param int $minSize
   * @param int $maxSize
   *
   * @throws \LiveTest\Exception
   */
  public function init($minSize = null, $maxSize = null)
  {
    if (is_null($maxSize) && is_null($minSize))
    {
      throw new \LiveTest\ConfigurationException('minSize nor maxSize where set.');
    }

    $this->minSize = $minSize;
    $this->maxSize = $maxSize;
  }

  /**
   * Checks the size of the given html document
   *
   * @see LiveTest\TestCase\General\Html.TestCase::runTest()
   */
  protected function runTest(Document $htmlDocument)
  {
    $size = strlen($htmlDocument->getHtml());

    if (!is_null($this->minSize))
    {
      if ($this->minSize >= $size)
      {
        throw new Exception('The given document is too small (expected min size: ' . $this->minSize . '; actual size: ' . $size . ')');
      }
    }

    if (!is_null($this->maxSize))
    {
      if ($this->maxSize <= $size)
      {
        throw new Exception('The given document is too big (expected max size: ' . $this->maxSize . '; actual size: ' . $size . ')');
      }
    }
  }
}