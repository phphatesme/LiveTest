<?php

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