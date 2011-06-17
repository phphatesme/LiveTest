<?php

namespace Test\Unit\LiveTest\Config\Parser;

use LiveTest\Connection\Session\Session;

use Base\Www\Uri;

use LiveTest\Config\TestSuite;
use LiveTest\Config\Parser\Parser;

use Base\Config\Yaml;

class ParserTest extends \PHPUnit_Framework_TestCase
{
  public function testParser()
  {
    $config = new TestSuite(new Session(new Uri('http://www.example.com')));
    $config->setBaseDir(__DIR__ . '/fixtures/');
    $configYaml = new Yaml(__DIR__ . '/fixtures/testsuite.yml');

    $parser = new Parser('LiveTest\\Config\\Tags\\TestSuite\\');
    $parsedConfig = $parser->parse($configYaml->toArray(), $config);
  }

  public function testUnknownTag()
  {
    $config = new TestSuite(new Session(new Uri('http://www.example.com')));
    $config->setBaseDir(__DIR__ . '/fixtures/');
    $configYaml = new Yaml(__DIR__ . '/fixtures/badtestsuite.yml');

    $parser = new Parser('LiveTest\\Config\\Tags\\TestSuite\\');
    $this->setExpectedException('LiveTest\Config\Parser\UnknownTagException');
    $parsedConfig = $parser->parse($configYaml->toArray(), $config);
  }
}