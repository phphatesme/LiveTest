<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Report\Format;

use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Information;

use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

/**
 * This format converts the results into a simple text list. It is used to print the
 * when running on command line.
 *
 * @author Nils Langner
 */
class SimpleList implements Format
{
  /**
   * Formats the results into a simple list.
   *
   * @param ResultSet $set
   * @param array $connectionStatuses
   * @param Information $information
   *
   * @return string
   */
  public function formatSet(ResultSet $set, array $connectionStatuses, Information $information)
  {
    $text = '';

    if (count($connectionStatuses) > 0)
    {
      $text .= "     Connection Statuses: \n\n";

      foreach ($connectionStatuses as $connectionStatus)
      {
        if ($connectionStatus->getType() == ConnectionStatus::ERROR)
        {
          echo "       Url     : " . $connectionStatus->getUri()->toString() . "\n";
          echo "       Message : " . $connectionStatus->getMessage() . "\n\n";
        }
      }
    }

    if (count($set) > 0)
    {
      $text .= "     Result Statuses:\n\n";

      foreach ($set as $result)
      {
        $test = $result->getTest();
        /* @var $test Test*/
        $text .= '     Url        :  ' . $result->getUri()->toString() . "\n";
        $text .= '     Test       :  ' . $test->getName() . "\n";
        $text .= '     Test Class :  ' . $test->getClassName() . "\n";
        switch ($result->getStatus())
        {
          case Result::STATUS_SUCCESS :
            $text .= '     Status     :  Success' . "\n";
            break;
          case Result::STATUS_FAILED :
            $text .= '     Status     :  Failed' . "\n";
            $text .= '     Message    :  ' . $result->getMessage() . "\n";
            break;
          case Result::STATUS_ERROR :
            $text .= '     Status     :  Error' . "\n";
            $text .= '     Message    :  ' . $result->getMessage() . "\n";
            break;
          default :
        }
        $text .= "\n";
      }
    }
    return $text;
  }
}