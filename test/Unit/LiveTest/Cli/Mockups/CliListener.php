<?php

namespace Unit\LiveTest\Cli\Mockups;

use LiveTest\Event\Dispatcher;
use LiveTest\Listener\Listener;

class CliListener implements Listener
{
  private $dispatcher;
  private $runId;

  private $arguments;
  private $configArguments;
  private $coreArguments;
  
  public function __construct($runId, Dispatcher $eventDispatcher)
  {
    $this->runId = $runId;
    $this->dispatcher = $eventDispatcher;
  }

 
  /**
   * @Event("LiveTest.Runner.Init")
   */
  public function runnerInit(array $arguments)
  {
    $this->arguments = $arguments;
  }
  
  /**
   * @Event("LiveTest.Runner.InitCore");
   */
  public function runnerInitCore(array $arguments)
  {
    $this->coreArguments = $arguments;
  }
  
 /**
   * @Event("LiveTest.Runner.InitConfig")
   */
  public function runnterInitConfig( $config )
  {
    $this->configArguments = $config;
  }
  
  public function getConfigDefaultDomain()
  {
    return $this->configArguments->getDefaultDomain()->toString();
  }
  
  public function getArgument( $name )
  {
    return $this->arguments[ $name ];
  }
   
  public function getCoreArgument( $name )
  {
    return $this->coreArguments[ $name ];;
  }
  
}