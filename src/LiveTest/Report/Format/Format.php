<?php

namespace LiveTest\Report\Format;

use LiveTest\TestRun\Information;
use LiveTest\TestRun\Result\ResultSet;

interface Format
{
  /**
   * Format the given test run results and return a string.
   * 
   * @param ResultSet $set
   * @param array $connectionStatuses
   * @param Information $information
   * 
   * @return string
   */
  public function formatSet(ResultSet $set, array $connectionStatuses, Information $information);
}