<?php

namespace phmLabs\Components\NamedParameters;

/**
 * This exception is used to signal that some parameters were wrong when
 * using the NamesParameters class.
 *
 * @author Nils Langner <langner@phmlabs.com>
 * @link http://www.phmlabs.com/Components/NamedParameters
 */
class Exception extends \Exception
{
  /**
   * The missing parameter name
   * @var string
   */
  private $missingParameter;

  /**
   * Set the missing parameter
   *
   * @param string $paramName
   */
  public function setMissingParameter($paramName)
  {
    $this->missingParameter = $paramName;
  }

  /**
   * Returns the missing parameter
   *
   * @return string
   */
  public function getMissingParameter()
  {
    return $this->missingParameter;
  }
}