<?php

namespace Test\Unit\LiveTest\Parser;

use Base\Config\Yaml;

use LiveTest\Config\Config;
use LiveTest\Config\Parser\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
  public function testParser()
  {
    $config = new Config();
    $config->setBaseDir(__DIR__ . '/fixtures/');
    $configYaml = new Yaml(__DIR__ . '/fixtures/testsuite.yml');

    $parser = new Parser();
    $parsedConfig = $parser->parse($configYaml->toArray(), $config);

   //    foreach ($parsedConfig->getTestCases() as $testCase)
  //    {
  //      \Base\Debug\DebugHelper::doVarDump($testCase['className']);
  //      \Base\Debug\DebugHelper::doVarDump($testCase['config']->getPages());
  //    }
  //
  //    \Base\Debug\DebugHelper::doVarDump($parsedConfig->getPages());
  }

  public function testUnknownTag()
  {
    $config = new Config();
    $config->setBaseDir(__DIR__ . '/fixtures/');
    $configYaml = new Yaml(__DIR__ . '/fixtures/badtestsuite.yml');

    $parser = new Parser();
    $this->setExpectedException('LiveTest\Config\Parser\Exception');
    $parsedConfig = $parser->parse($configYaml->toArray(), $config);
  }
}