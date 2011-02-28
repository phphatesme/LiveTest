<?php

namespace LiveTest\Config\Tags\TestSuite;

use Base\Config\Yaml;



class IncludedTestSuites extends Base
{
  protected function doProcess(\LiveTest\Config\TestSuite $config, array $parameters)
  {
    foreach( $parameters as $file )
    {
			$yamlFile = new Yaml($config->getBaseDir().DIRECTORY_SEPARATOR.$file);
			$this->getParser()->parse($yamlFile->toArray(), $config);
    }
  }
}