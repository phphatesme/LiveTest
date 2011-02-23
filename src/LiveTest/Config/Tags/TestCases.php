<?php

namespace LiveTest\Config\Tags;

class TestCases extends Base
{
  public function process()
  {
    $config = $this->getConfig();
    foreach ($this->getParameters() as $name => $value)
    {
      $parameters = array();
      if (array_key_exists('Parameter', $value))
      {
        $parameters = $value['Parameter'];
      }

      $testCaseConfig = $this->getConfig()->createTestCase($name, $value['TestCase'], $parameters);

      unset($value['Parameter']);
      unset($value['TestCase']);

      $this->getParser()->parse($value, $testCaseConfig);
    }
    return $config;
  }
}