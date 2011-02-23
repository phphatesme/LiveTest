<?php

namespace LiveTest\Report\Writer;

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