<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\ConfigurationException;

use Base\Config\Yaml;
use Zend\Config\Exception\InvalidArgumentException;

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
      // @todo base dir must be set. Would be a conflict if the standard config is overwritten.
      $filename = $config->getBaseDir() . DIRECTORY_SEPARATOR . $file;
      try
      {
      	$yamlFile = new Yaml($filename);
      }
      catch(InvalidArgumentException $e)
      {
      	throw new ConfigurationException('The included testsuite configuration file ("' . $filename . '") was not found.', null, $e);
      }
      $this->getParser()->parse($yamlFile->toArray(), $config);
    }
  }
}