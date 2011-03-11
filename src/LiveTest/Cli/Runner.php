<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Cli;

use Zend\Http\Client\Adapter\Curl;

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
use Base\Http\Client\Zend;

/**
 * This runner is used to prepare the test run. It converts the yaml files to
 * config objects, sets mandatory parameters and registers all the listener.
 *
 * @todo too much non cli spercific stuff is done here
 *
 * @author Nils Langner
 */
class Runner extends ArgumentRunner
{
  /**
   * The global config file
   * @var ConfigConfig
   */
  private $config;

  /**
   * The event dispatcher
   * @var Dispatcher
   */
  private $eventDispatcher;

  /**
   * The test run instance
   * @var TestRun
   */
  private $testRun;

  /**
   * The unique run id
   * @var string
   */
  private $runId;

  /**
   * Can the run method be called
   * @var boolean
   */
  private $runAllowed = true;

  /**
   * This function intializes the runner. It sets the runId, inits the configuration
   * and registers the assigned listeners. Afterwards all listeners are notified. If
   * a listener returns false on notification the runner is noit able to run.
   *
   * @notify LiveTest.Runner.InitConfig
   * @notify LiveTest.Runner.Init
   *
   * @param array $arguments
   * @param Dispatcher $dispatcher
   */
  public function __construct($arguments, Dispatcher $dispatcher)
  {
    $this->eventDispatcher = $dispatcher;
    $this->initRunId();
    $this->initCoreListener($arguments);

    parent::__construct($arguments);

    $this->initConfig();
    $this->initListeners();

    $this->eventDispatcher->notify('LiveTest.Runner.InitConfig', array('config' => $this->config));
    // @todo should there be a naming convention for events? Something like checkSomething if the return
    //       value will change the workflow. see symfony ::filter (e.g. manipulate)
    $this->runAllowed = $this->eventDispatcher->notify('LiveTest.Runner.Init', array('arguments' => $arguments));
  }

  public function initCoreListener($arguments)
  {
    $this->eventDispatcher->registerListener(new \LiveTest\Listener\Cli\Debug($this->runId, $this->eventDispatcher));
    $this->eventDispatcher->registerListener(new \LiveTest\Packages\Feedback\Listener\Send($this->runId, $this->eventDispatcher));
    $this->eventDispatcher->notify('LiveTest.Runner.InitCore', array('arguments' => $arguments));
  }

  /**
   * Initializes the unique run id
   */
  private function initRunId()
  {
    $this->runId = (string)time();
  }

  /**
   * This function parses the config array and returns a config object. This config
   * object can be handled by the event dispatcher.

   * @param array $configArray
   * @return ConfigConfig
   */
  private function parseConfig($configArray)
  {
    $config = new ConfigConfig();

    $parser = new Parser('\\LiveTest\Config\\Tags\\Config\\');
    $config = $parser->parse($configArray, $config);

    return $config;
  }

  /**
   * Initializes the global configuration. If the config argument is set, the default
   * configuration and the given config file are merged. Otherwise the default config
   * is taken.
   */
  private function initConfig()
  {
    $config = new Yaml(__DIR__ . '/../../default/config.yml', true);

    if ($this->hasArgument('config'))
    {
      $currentConfig = new Yaml($this->getArgument('config'), true);
      $config = $config->merge($currentConfig);
    }
    $this->config = $this->parseConfig($config->toArray());
  }

  /**
   * This function initializes and registrates all the listeners.
   */
  private function initListeners()
  {
    $this->eventDispatcher->registerListenersByConfig($this->config, $this->runId);
  }

  /**
   * Returns true if the runner can be run. It will return false if a listener stops
   * the run workflow.
   */
  public function isRunAllowed()
  {
    return $this->runAllowed;
  }

  /**
   * Initializes the test run.
   */
  private function initTestRun()
  {
    $properties = Properties::createByYamlFile($this->getArgument('testsuite'), $this->config->getDefaultDomain());

    $client = new Zend();
    $client->setAdapter(new Curl());
    $this->eventDispatcher->notify('LiveTest.Runner.InitHttpClient', array('client' => $client));

    $this->testRun = new Run($properties, $client, $this->eventDispatcher);
  }

  /**
   * Runs the runner. Before running you should check if run is allowed (isRunAllowed())
   *
   * @see Base\Cli.Runner::run()
   */
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