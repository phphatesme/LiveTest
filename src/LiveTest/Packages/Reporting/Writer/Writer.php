<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Reporting\Writer;

/**
 * A writer is used to write a formatted text to a defined medium (e.g.: file, echo, email). 
 * 
 * @author Nils Langner
 *
 */
interface Writer
{
  /**
   * Writes a formatted text to a defined medium.
   * 
   * @param string $formatedText
   */
  public function write($formatedText);
}