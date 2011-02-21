<?php

namespace LiveTest\Listener;

use Base\Http\ConnectionStatus;

/**
 * This extension is used to let the application sleep after a test ran. This is used
 * to not DOS attack a server.
 * 
 * @author Nils Langner
 *
 */
class Sleep extends Base
{
  private $sleepTime;
  
  /**
   * This function sets the sleep time
   * 
   * @param int $sleepTime Time to sleep in seconds
   */
  public function init($sleepTime = 1)
  {
    $this->sleepTime = $sleepTime;
  }
  
  /**
   * Lets the application sleep for a defined time
   * 
   * @event LiveTest.Run.HandleConnectionStatus
   * 
   * @param ConnectionStatus $status
   */
  public function handleConnectionStatus(ConnectionStatus $connectionStatus)
  {
    sleep($this->sleepTime);
  }
}