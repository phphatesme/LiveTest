<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\Parser\Parser;

/**
 * This abstract class is used to simplify the standard tags. Instead of handling parser, config object etc.
 * you only have to implement the doProcess method for all standard features.
 *
 * @author Nils Langner
 */
abstract class Base implements Tag
{
  private $configParameters;
  private $config;
  private $parser;

  /**
   * @param array $configParameters
   * @param \LiveTest\Config\TestSuite $config
   * @param Parser $parser
   */
  public function __construct(array $configParameters, \LiveTest\Config\TestSuite $config, Parser $parser)
  {
    $this->configParameters = $configParameters;
    $this->config = $config;
    $this->parser = $parser;
  }

  /**
   * Returns the parser that can be used handle tags that are unknown within a special tag.
   *
   * @return Parser
   */
  protected function getParser()
  {
    return $this->parser;
  }

  /**
   * Processes the tag
   *
   * @see LiveTest\Config\Tags\TestSuite.Tag::process()
   *
   * @return mixed
   */
  final public function process()
  {
    return $this->doProcess($this->config, $this->configParameters);
  }

  /**
   * This abstract function is a simplified processing method.
   *
   * @param TestSuite $config
   * @param array $parameters
   */
  abstract protected function doProcess(\LiveTest\Config\TestSuite $config, array $parameters);
}