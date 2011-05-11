<?php

namespace LiveTest\Packages\Runner\Listeners;

use LiveTest\ConfigurationException;

use LiveTest\Listener\Base;

class Preconditions extends Base
{
  private $arguments = array();

  /**
   * @Event("LiveTest.Runner.Init")
   * @param array $arguments
   */
  public function runnerInit(array $arguments)
  {
    $this->arguments = $arguments;
  }

  /**
   * @Event("LiveTest.Runner.InitTestRun")
   */
  public function checkPreconditions()
  {
    if (!array_key_exists('testsuite', $this->arguments) || $this->arguments['testsuite'] == '')
    {
      throw new ConfigurationException('The mandatory --testsuite argument was not found. ' . 'Please use LiveTest --help for more information.');
    }
  }
}