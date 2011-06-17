<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Cli;

use Zend\Http\CookieJar;

use LiveTest\ConfigurationException;

use phmLabs\Components\Annovent\Event\Event;

use Zend\Http\Client\Adapter\Curl;

use LiveTest\Config\Parser\Parser;
use LiveTest\Config\ConfigConfig;
use LiveTest\Event\Dispatcher;
use LiveTest\Listener\Listener;
use LiveTest\TestRun\Properties;
use LiveTest\TestRun\Run;

use Base;
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
   * a listener returns false on notification the runner is not able to run.
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
    $this->eventDispatcher->simpleNotify('LiveTest.Runner.InitConfig', array ('config' => $this->config));
    
    $this->initListeners();
    $event = new Event('LiveTest.Runner.Init', array ('arguments' => $arguments));
    $this->eventDispatcher->notifyUntil($event);
    $this->runAllowed = !$event->isProcessed();
  }
  
  private function initCoreListener($arguments)
  {
    $this->eventDispatcher->connectListener(new \LiveTest\Packages\Debug\Listeners\Debug($this->runId, $this->eventDispatcher), 10);
    $this->eventDispatcher->connectListener(new \LiveTest\Packages\Feedback\Listener\Send($this->runId, $this->eventDispatcher), 10);
    $this->eventDispatcher->connectListener(new \LiveTest\Packages\Runner\Listeners\Credentials($this->runId, $this->eventDispatcher), 10);
    $this->eventDispatcher->simpleNotify('LiveTest.Runner.InitCore', array ('arguments' => $arguments));
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
    try
    {
      $config = $parser->parse($configArray, $config);
    }
    catch (\LiveTest\Config\Parser\UnknownTagException $e)
    {
      throw new ConfigurationException('Unknown tag ("' . $e->getTagName() . '") found in the configuration file.', null, $e);
    }
    
    return $config;
  }
  
  /**
   * Initializes the global configuration. If the config argument is set, the default
   * configuration and the given config file are merged. Otherwise the default config
   * is taken.
   */
  private function initConfig()
  {
    $config = new Yaml(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR . 'config.yml', true);
    
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
    $this->eventDispatcher->registerByConfig($this->config, $this->runId);
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
    $this->eventDispatcher->simpleNotify('LiveTest.Runner.InitTestRun');
    
    try
    {
      $properties = Properties::createByYamlFile($this->getArgument('testsuite'), $this->config->getDefaultDomain());
    }
    catch (\Zend\Config\Exception\InvalidArgumentException $e)
    {
      throw new ConfigurationException('The given testsuite configuration file ("' . $this->getArgument('testsuite') . '") was not found.', null, $e);
    }
    catch (\InvalidArgumentException $e)
    {
      throw new ConfigurationException('Error parsing testsuite configuration: ' . $e->getMessage(), null, $e);
    }
    
		$clients =  $this->getClients($properties->getSessions());
    
    $this->testRun = new Run($properties, $clients, $this->eventDispatcher);
  }
  
  private function getClients( $sessions )
  {
    $clients = array();
    foreach ($sessions as $sessionName => $session)
    {
      $client = new Zend();
      if (!$session->areRequestsIsolated())
      {
        $client->setCookieJar(new CookieJar());
      }
      $client->setAdapter(new Curl());
    	$this->eventDispatcher->simpleNotify('LiveTest.Runner.InitHttpClient', array ('client' => $client, 'sessionName' => $sessionName));
      $clients[$sessionName] = $client;
    }
    return $clients;
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