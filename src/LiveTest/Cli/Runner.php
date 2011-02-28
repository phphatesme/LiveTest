<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Cli;

use Base\Http\Client\Zend;

use LiveTest\Config\Parser\Parser;
use LiveTest\Config\ConfigConfig;
use LiveTest\Event\Dispatcher;
use LiveTest\Listener\Listener;
use LiveTest\TestRun\Properties;
use LiveTest\TestRun\Run;

use Base;
use Base\Www\Uri;
use Base\Cli\ArgumentRunner;
use Base\Config\Yaml;

class Runner extends ArgumentRunner
{
  private $config;
  private $testSuiteConfig;

  private $eventDispatcher;

  private $testRun;
  private $runId;

  private $runAllowed = true;

  private $defaultDomain = 'http://www.example.com';

  public function __construct($arguments, Dispatcher $dispatcher)
  {
    parent::__construct($arguments);

    $this->eventDispatcher = $dispatcher;

    $this->initRunId();
    $this->initConfig();
    $this->initListeners($arguments);
  }

  private function initRunId()
  {
    $this->runId = (string)time();
  }

  private function parseConfig($configArray)
  {
    $config = new ConfigConfig();
    $config->setDefaultDomain(new Uri($this->defaultDomain));

    $parser = new Parser('\\LiveTest\Config\\Tags\\Config\\');
    $parser->parse($configArray, $config);

    return $config;
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

    if (!is_null($currentConfig->Listener))
    {
      $currentConfig->Listener = $defaultConfig->Listener->merge($currentConfig->Listener);
    }
    else
    {
      $currentConfig->Listener = $defaultConfig->Listener;
    }

    $this->config = $this->parseConfig($currentConfig->toArray());
  }

  /**
   * @notify LiveTest.Runner.Init
   *
   * @param array $arguments
   */
  private function initListeners($arguments)
  {
    $this->eventDispatcher->registerListenersByConfig($this->config, $this->runId);

    // @todo should there be a naming convention for events? Something like checkSomething if the return
    //       value will change the workflow.
    $this->runAllowed = $this->eventDispatcher->notify('LiveTest.Runner.Init', array ('arguments' => $arguments ));
  }

  public function isRunAllowed()
  {
    return $this->runAllowed;
  }

  private function initTestRun()
  {
    $properties = Properties::createByYamlFile($this->getArgument('testsuite'), $this->config->getDefaultDomain());

    $client = new Zend();
    $this->eventDispatcher->notify('LiveTest.Runner.InitHttpClient', array ('client' => $client ));

    $this->testRun = new Run($properties, $client, $this->eventDispatcher);
  }

  public function run()
  {
    if ($this->isRunAllowed())
    {
      $this->initTestRun();
      $this->testRun->run();
    }
    else
    {
      throw new Exception('Not allowed to run');
    }
  }
}