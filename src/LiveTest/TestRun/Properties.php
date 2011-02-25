<?php

namespace LiveTest\TestRun;

use LiveTest\Config\Parser\Parser;

use Base\Config\Yaml;

use Base\Www\Uri;

use LiveTest\Config\Config;

class Properties
{
  private $defaultDomain;
  private $config;

  private $testSets = array();

  public function __construct(Config $config, Uri $defaultDomain)
  {
    $this->defaultDomain = $defaultDomain;
    $this->config = $config;

    $this->initTestSets();
  }

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

  public function getDefaultDomain()
  {
    return $this->defaultDomain;
  }

  public function getTestSets()
  {
    return $this->testSets;
  }

  /**
   * @todo is this method neccessary? If yes: Where to put it? At the moment it is only used to make testing easier
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