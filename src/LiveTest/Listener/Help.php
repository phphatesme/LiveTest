<?php

namespace LiveTest\Listener;

use LiveTest\TestRun\Properties;

/**
 * This extension is used to print the help content if the --help argument is set
 * 
 * @author Nils Langner
 */
class Help extends Base
{
  /**
   * This template that contains the help text
   * 
   * @var string The filename. Relative to __DIR__. 
   */
  private $template = 'Help/template.tpl';
  
  /**
   * This function echoes the global help if the --help command line argument is set
   * 
   * @event LiveTest.Runner.Init
   * 
   * @param array $arguments
   */
  public function runnerInit(array $arguments)
  {
    if (array_key_exists('help', $arguments) || count($arguments) == 0)
    {
      echo file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . $this->template);
      return false;
    }
    return true;
  }
}