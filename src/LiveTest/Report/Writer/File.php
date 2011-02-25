<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
    $file = new  \Base\File\File($this->filename);
    $file->setContent($formatedText);
    $file->save();
  }
}
