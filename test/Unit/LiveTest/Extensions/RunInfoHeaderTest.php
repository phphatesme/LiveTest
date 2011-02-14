<?php

namespace Test\Unit\LiveTest\Extensions;

use Base\Config\Yaml;
use Base\Www\Uri;

use LiveTest\TestRun\Properties;
use LiveTest\Extensions\RunInfoHeader;

class RunInfoHeaderTest extends \PHPUnit_Framework_TestCase
{
  private $yamlTestSuiteConfig = '/fixtures/RunInfoHeaderTestSuiteConfig.yml';
  
  private $extension;
  
  protected function setUp()
  {
    $this->extension = new RunInfoHeader('');
  }
  
  public function testPreRun( )
  {
    $config = new Yaml(__DIR__.$this->yamlTestSuiteConfig);
    $properties = new Properties($config, new Uri('http://www.example.com'));
    
    ob_start();
    $this->extension->preRun($properties);
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