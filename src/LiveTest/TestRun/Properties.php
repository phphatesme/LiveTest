<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun;

use LiveTest\Config\Parser\Parser;
use LiveTest\Config\Config;

use Base\Config\Yaml;
use Base\Www\Uri;

/**
 * A properties class holds all information about a test run. It prepares athe data given by
 * a config file to be used in a test run.
 *
 * @author Nils Langner
 */
class Properties
{
  /**
   * The default domain
   * @var Uri
   */
  private $defaultDomain;

  /**
   * The configuration with all needed data
   * @var Config
   */
  private $config;

  /**
   * Array of test sets
   * @var TestSet[]
   */
  private $testSets = array();

  /**
   * @param Config $config
   * @param Uri $defaultDomain
   */
  public function __construct(Config $config, Uri $defaultDomain)
  {
    $this->defaultDomain = $defaultDomain;
    $this->config = $config;

    $this->initTestSets();
  }

  /**
   * This function converts the information given in a config file to a number of test sets.
   */

  private function initTestSets()
  {
    $testCases = $this->config->getTestCases();
    foreach ($testCases as $testCase)
    {
      $config = $testCase['config'];
      foreach ($config->getPages() as $page)
      {
        $uri = $this->defaultDomain->concatUri($page);
        if (!array_key_exists($page, $this->testSets))
        {
          $this->testSets[$page] = new TestSet($uri);
        }

        $test = new Test($testCase['name'], $testCase['className'], $testCase['parameters']);
        $this->testSets[$page]->addTest($test);
      }
    }
  }

  /**
   * Returns the default domian
   *
   * @return Uri
   */
  public function getDefaultDomain()
  {
    return $this->defaultDomain;
  }

  /**
   * Returns the test sets
   *
   * @return TestSet[]
   */
  public function getTestSets()
  {
    return $this->testSets;
  }

  /**
   * Creates a properties object that was created using a yaml file.
   *
   * @todo is this method neccessary? If yes: Where to put it? At the moment it is only used to make testing easier
   *
   * @param String $filename The file name of the yaml file
   * @param Uri $defaultUri The default uri
   */
  public static function createByYamlFile($filename, Uri $defaultUri)
  {
    $yamlConfig = new Yaml($filename);

    $testSuiteConfig = new Config();
    $testSuiteConfig->setBaseDir(dirname($filename));
    $parser = new Parser();
    $testSuiteConfig = $parser->parse($yamlConfig->toArray(), $testSuiteConfig);

    return new self($testSuiteConfig, $defaultUri);
    ;
  }
}