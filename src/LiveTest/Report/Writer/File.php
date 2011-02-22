<?php

namespace LiveTest\Report\Writer;

use LiveTest\Exception;

/**
 * This writer puts the formatted text into a file.
 * 
 * @author Nils Langner
 */
class File implements Writer
{
  /**
   * The file name
   * @var Nils Langner
   */
  private $filename;

  /**
   * Set the filename.
   * 
   * @param string $filename
   */
  public function init($filename)
  {
    $this->filename = $filename;
  }

  /**
   * Writes the formatted text into the given file.
   * 
   * @param string $formatedText
   */
  public function write($formatedText)
  {
    file_put_contents($this->filename, $formatedText);
  }
}