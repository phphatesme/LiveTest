<?php

namespace LiveTest\Report\Format;

use LiveTest\TestRun\Information;

use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

class SimpleList implements Format
{
  public function formatSet(ResultSet $set, array $connectionStatuses, Information $information)
  {
    $text = '';
    foreach ( $set->getResults() as $result )
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
    return $text;
  }
}
