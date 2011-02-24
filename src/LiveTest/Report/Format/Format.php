<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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