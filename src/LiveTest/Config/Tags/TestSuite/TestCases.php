<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\TestSuiteConfig;

class TestCases extends Base
{
  protected function doProcess(TestSuiteConfig $config, array $parameters)
  {
    foreach ($parameters as $name => $value)
    {
      $testParameters = array();
      if (array_key_exists('Parameter', $value))
      {
        $testParameters = $value['Parameter'];
      }

      $testCaseConfig = $config->createTestCase($name, $value['TestCase'], $testParameters);

      unset($value['Parameter']);
      unset($value['TestCase']);

      $this->getParser()->parse($value, $testCaseConfig);
    }
  }
}