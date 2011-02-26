<?php

namespace LiveTest\Config\Tags\TestSuite;

use Base\Config\Yaml;

use LiveTest\Config\TestSuiteConfig;

class IncludedTestSuites extends Base
{
  protected function doProcess(TestSuiteConfig $config, array $parameters)
  {
    foreach( $parameters as $file )
    {
			$yamlFile = new Yaml($config->getBaseDir().DIRECTORY_SEPARATOR.$file);
			$this->getParser()->parse($yamlFile->toArray(), $config);
    }
  }
}