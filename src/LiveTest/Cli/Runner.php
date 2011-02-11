<?php

namespace LiveTest\Cli;

use Base\Www\Uri;

use LiveTest\TestRun;

use LiveTest\TestRun\Result\Handler\ResultSetHandler;

use Base\Cli\ArgumentRunner;
use Base\Logger\NullLogger;
use Base\Config\Yaml;
use Base\Http\Client;

use LiveTest\TestRun\Properties;
use LiveTest\TestRun\Run;

class Runner extends ArgumentRunner
{
  protected $mandatoryArguments = array('testsuite');
  
  private $config;
  private $testSuiteConfig;
  
  private $extensions = array();
  
  private $testRun;
  private $runId;
  
  private $defaultDomain = 'http://www.example.com';
  
  public function __construct($arguments)
  {
    parent::__construct($arguments);
    
    $this->initRunId();
    $this->initConfig();
    $this->initTestSuiteConfig();
    $this->initExtensions($arguments);
    $this->initDefaultDomain();
  }
  
  private function initDefaultDomain()
  {
    $domain = $this->config->DefaultDomain;
    if ($domain != '')
    {
      $this->defaultDomain = (string)$domain;
    }
  }
  
  private function initRunId()
  {
    $this->runId = (string)time();
  }
  
  private function initConfig()
  {
    if ($this->hasArgument('config'))
    {
      $configFileName = $this->getArgument('config');
    }
    else
    {
      $configFileName = __DIR__ . '/../../default/config.yml';
    }
        
    if (!file_exists($configFileName))
    {
      throw new \LiveTest\Exception('The config file (' . $configFileName . ') was not found.');
    }
    
    $defaultConfig = new Yaml(__DIR__ . '/../../default/config.yml', true);
    $currentConfig = new Yaml($configFileName, true);
    
    if (!is_null($currentConfig->Extensions))
    {
      $currentConfig->Extensions = $defaultConfig->Extensions->merge($currentConfig->Extensions);
    }
    else
    {
      $currentConfig->Extensions = $defaultConfig->Extensions;
    }
    $this->config = $currentConfig;
  }
  
  private function initTestSuiteConfig()
  {
    $testSuiteFileName = $this->getArgument('testsuite');
    $this->testSuiteConfig = new Yaml($testSuiteFileName);
  }
  
  private function initExtensions($arguments)
  {
    if (!is_null($this->config->Extensions))
    {
      foreach ($this->config->Extensions as $name => $extensionConfig)
      {
        $className = (string)$extensionConfig->class;
        if ($className == '')
        {
          throw new Exception('The class name for the "' . $name . '" extension is missing. Please check your configuration.');
        }
        $parameter = $extensionConfig->parameter;
        $this->extensions[$name] = new $className($this->runId, $parameter, $arguments);
      }
    }
  }
  
  private function initTestRun()
  {
    $testRunProperties = new Properties($this->testSuiteConfig, new Uri($this->defaultDomain));
    $this->testRun = new Run($testRunProperties, new Client());
    
    foreach ($this->extensions as $extension)
    {
      $this->testRun->addExtension($extension);
    }
  }
  
  public function run()
  {
    $this->initTestRun();
    $this->testRun->run();
  }
}
