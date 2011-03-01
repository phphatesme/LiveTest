<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

use Base\Config\Yaml;

/**
 * This tag includes and parses an external test suite file.
 *
 * @example
 *  IncludedTestSuites:
 *   - includedTestSuite.yml
 *
 * @author Nils Langner
 */
class IncludedTestSuites extends Base
{
  protected function doProcess(\LiveTest\Config\TestSuite $config, array $parameters)
  {
    foreach ($parameters as $file)
    {
      // @todo base dir must be set
      $yamlFile = new Yaml($config->getBaseDir() . DIRECTORY_SEPARATOR . $file);
      $this->getParser()->parse($yamlFile->toArray(), $config);
    }
  }
}