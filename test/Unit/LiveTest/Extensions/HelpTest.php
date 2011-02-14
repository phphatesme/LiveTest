<?php

namespace Test\Unit\LiveTest\Extensions;

use Base\Config\Yaml;
use Base\Www\Uri;
use Base\Timer\Timer;
use Base\Http\Response;

use LiveTest\TestRun\Properties;
use LiveTest\Extensions\Help;
use LiveTest\Extensions\Sleep;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class HelpTest extends \PHPUnit_Framework_TestCase
{
  private $testsuite = 'fixtures/HelpTestSuiteConfig.yml';
  
  private $extension;
    
  public function testPreRunArguments()
  {
    $config = new \Zend_Config(array() );
    $this->extension = new Help('', $config, array('testsuite' => '' ) );
    
    ob_start();
    $this->extension->preRun(new Properties(new Yaml(__DIR__.DIRECTORY_SEPARATOR.$this->testsuite), new Uri( 'http://www.example.com' )));
    $output = ob_get_contents(); 
    ob_clean();
    
    $this->assertEquals( '', $output );
  }
  
  public function testPreRunNone()
  {
    $config = new \Zend_Config(array() );
    $this->extension = new Help('', $config, array( ) );
    
    ob_start();
    $this->extension->preRun(new Properties(new Yaml(__DIR__.DIRECTORY_SEPARATOR.$this->testsuite), new Uri( 'http://www.example.com' )));
    $output = ob_get_contents(); 
    ob_clean();
    
    $expected = file_get_contents(__DIR__.'/../../../../src/LiveTest/Extensions/Help/template.tpl');
    
    $this->assertEquals( $expected, $output );
  }  
  
  public function testPreRunHelp()
  {
    $config = new \Zend_Config(array() );
    $this->extension = new Help('', $config, array('help' => '') );
    
    ob_start();
    $this->extension->preRun(new Properties(new Yaml(__DIR__.DIRECTORY_SEPARATOR.$this->testsuite), new Uri( 'http://www.example.com' )));
    $output = ob_get_contents();
    ob_clean();
    
    $expected = file_get_contents(__DIR__.'/../../../../src/LiveTest/Extensions/Help/template.tpl');
        
    $this->assertEquals( $expected, $output );
  }
}
