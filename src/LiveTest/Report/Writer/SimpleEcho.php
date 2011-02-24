<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Report\Writer;

/**
 * This writer echoes the output.
 * 
 * @author Nils Langner
 *
 */
class SimpleEcho implements Writer
{
  /**
   * This function echoes the formatted text.
   * 
   * @param string $formatedText
   */
  public function write($formatedText)
  {
    echo "\n\n";
    echo $formatedText;
  }
}