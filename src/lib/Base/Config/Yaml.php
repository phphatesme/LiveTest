<?php

namespace Base\Config;

use Zend\Config\Exception\InvalidArgumentException;
use Zend\Config\Config as ZendConfig;

use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Yaml extends ZendConfig implements Config
{
  private $filename;

  /**
   * @throws InvalidArgumentException from sfYaml::load
   * @throws Zend_Config_Exception
   * @param string $filename
   * @param boolean $allowModifications
   */
  public function __construct($filename, $allowModifications = false)
  {
    $this->filename = $filename;

    $this->checkIfFilenameIsFile();

    $content = SymfonyYaml::load($this->filename);

    if (is_null($content))
    {
      $content = array();
    }

    parent::__construct($content, $allowModifications);
  }

  /**
   * This function returns the filename of the information providing file
   *
   * @see Base\Config\Config::getFilename()
   */
  public function getFilename()
  {
    return $this->filename;
  }

  /**
   * This function will throws an exception if $this->filename does not point to
   * an existing file.
   *
   * @throws Zend_Config_Exception
   */
  private function checkIfFilenameIsFile()
  {
    if (!is_file($this->filename))
    {
      throw new InvalidArgumentException('File described by filename: "' . $this->filename . '" is not a file.');
    }
  }
}