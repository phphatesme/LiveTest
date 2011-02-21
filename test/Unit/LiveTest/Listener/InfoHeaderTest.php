<?php

namespace Test\Unit\LiveTest\Listener;

use Annovent\Event\Dispatcher;

use Base\Config\Yaml;
use Base\Www\Uri;

use LiveTest\TestRun\Properties;
use LiveTest\Listener\InfoHeader;

class InfoHeaderTest extends \PHPUnit_Framework_TestCase
{
  private $yamlTestSuiteConfig = '/fixtures/InfoHeaderTestSuiteConfig.yml';

  private $listener;

  protected function setUp()
  {
    $this->listener = new InfoHeader('', new Dispatcher());
  }

  public function testPreRun( )
  {
    $config = new Yaml(__DIR__.$this->yamlTestSuiteConfig);
    $properties = new Properties($config, new Uri('http://www.example.com'));

    ob_start();
    $this->listener->preRun($properties);
    $output = ob_get_contents();
    ob_clean();

    $expected = "  Default Domain  : http://www.example.com\n  Start Time      : 2011-02-14 16:43:09\n\n".
                "  Number of URIs  : 3\n  Number of Tests : 6\n\n";

    $output = explode("\n", $output);

    $this->assertEquals( '  Default Domain  : http://www.example.com', $output[0] );
    $this->assertEquals( '  Number of URIs  : 3', $output[3] );
    $this->assertEquals( '  Number of Tests : 6', $output[4] );
  }
}