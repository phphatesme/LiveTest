<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Reporting\Format;

use LiveTest\TestRun\Information;

use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

/**
 * This format converts the test result into a comma separated list.
 *
 * @author Nils Langner
 */
class Csv implements Format
{
  /**
   * Formats ths test result into csv style.
   *
   * @param ResultSet $set
   * @param array $connectionStatuses
   * @param Information $information
   */
  public function formatSet(ResultSet $set, array $connectionStatuses, Information $information)
  {
    $text = '';
    foreach ( $set as $result )
    {
      $test = $result->getTest();

      $text .= $result->getRequest()->getUri() . ";".$test->getName().";".$test->getClassName().";"
               . $result->getStatus()."\n";
    }
    return $text;
  }
}
