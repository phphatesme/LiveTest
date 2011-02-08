<?php

namespace Test\Unit\LiveTest\Extensions;

use Base\Config\Yaml;
use Base\Www\Uri;

use LiveTest\TestRun\Properties;
use LiveTest\Extensions\RunInfoHeader;

class RunInfoHeaderTest extends \PHPUnit_Framework_TestCase
{
  private $yamlTestStuiteConfig = 'fixtures/RunInfoHeaderTestSuiteConfig.yml';
  
  private $extension;
  
  protected function setUp()
  {
    $this->extension = new RunInfoHeader('');
  }
  
  public function testPreRun( )
  {
    $config = new Yaml($this->yamlTestStuiteConfig);
    $properties = new Properties($config, new Uri('http://www.example.com'));
    
    ob_start();
    $this->extension->preRun($properties);
    $output = ob_get_contents();
    ob_clean();
    
    $expected = "  Default Domain  : http://www.example.com\n  Number of Tests : 6\n\n";  

    $this->assertEquals( $expected, $output );
  }
}