<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Listener\Cli;

use LiveTest\Listener\Base;

/**
 * This extension is used to let the application sleep after a test ran. This is used
 * to not DOS attack a server.
 *
 * @author Nils Langner
 *
 */
class Debug extends Base
{
  private $debug = false;

  /**
   * @event LiveTest.Runner.Init
   *
   * @param array $arguments
   */
  public function runnerInit(array $arguments)
  {
    if (array_key_exists('debug', $arguments))
    {
      $this->debug = true;
    }
    return true;
  }

  /**
   * @todo add exception pretty print
   *
   * @event LiveTest.Runner.Error
   *
   * @param \Exception $e
   */
  public function handleException(\Exception $exception)
  {
    if ($this->debug)
    {
      throw $exception;
      return false;
    }
    else
    {
      echo "  An error occured: " . $exception->getMessage() . " (" . get_class($exception) . ")";
    }
  }
}