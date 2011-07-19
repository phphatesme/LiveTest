<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

/**
 * This tag adds the test cases to the configuration. All tags that are not known withing this class are
 * handed to parser.
 *
 * @example
 * TestCases:
 * TextPresent_body:
 * TestCase: LiveTest\TestCase\General\Html\TextPresent
 * Parameter:
 * text: "unpresent_text"
 *
 * @author Nils Langner
 */
use LiveTest\ConfigurationException;

use Base\Config\Yaml;

use LiveTest\Config\TestSuite;

class TestSuites extends Base
{
  /**
   * @see LiveTest\Config\Tags\TestSuite.Base::doProcess()
   *
   * @fixme does not work if no Pages are added
   */
  protected function doProcess(\LiveTest\Config\TestSuite $config, $testsuites)
  {
    foreach ($testsuites as $testsuite)
    {
      $filename = $testsuite['filename'];
      unset($testsuite['filename']);

      // @todo must be part of base library
      if (strpos($filename, '/') > 0)
      {
        $filename = $config->getBaseDir() . '/' . $filename;
      }

      try
      {
        $yaml = new Yaml($filename);
      }
      catch (\Exception $e)
      {
        throw new ConfigurationException("Error parsing included testsuite '" . $filename . "': " . $e->getMessage(), null, $e);
      }

      $testSuiteConfig = new TestSuite($config->getCurrentSession(), $config);
      $testSuiteConfig->setDefaultDomain($config->getDefaultDomain());

      $parameters = $yaml->toArray();
      $this->getParser()->parse($parameters, $testSuiteConfig);
      $this->getParser()->parse($testsuite, $testSuiteConfig);
    }
  }
}