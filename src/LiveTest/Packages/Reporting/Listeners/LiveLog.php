<?php

namespace LiveTest\Packages\Reporting\Listeners;

use LiveTest\TestRun\Result\Result;

class LiveLog
{
  private $handle;

  public function init($filename)
  {
    $this->handle = fopen($filename, 'w');
    $log = array ('#', 'Status', 'Uri', 'Message');
    fputcsv($this->handle, $log, ';');
  }

  /**
   * @Event("LiveTest.Run.HandleResult")
   */
  public function handleResult(Result $result)
  {
    static $counter = 1;
    $log = array ($counter, $result->getStatus(), $result->getRequest()->getUri(), $result->getMessage());
    fputcsv($this->handle, $log, ';');
    $counter ++;
  }

  /**
   * @Event("LiveTest.Run.PostRun")
   */
  public function postRun()
  {
    fclose($this->handle);
  }
}