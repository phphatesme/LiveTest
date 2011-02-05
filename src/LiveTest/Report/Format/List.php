<?php

namespace LiveTest\Report\Format;

use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

class List implements Format
{
  public function formatSet(ResultSet $set)
  {
    $text = '';
    foreach ($set->getResults() as $result)
    {
      $test = $result->getTest();
      /* @var $test Test*/
      $text .= '     Url        :  ' . $result->getUrl() . "\n";
      $text .= '     Test       :  ' . $test->getName() . "\n";
      $text .= '     Test Class :  ' . $test->getClass() . "\n";
      switch ($result->getStatus())
      {
        case Result::STATUS_SUCCESS :
          $text .= '     Status     :  Success' . "\n";
          break;
        case Result::STATUS_FAILED :
          $text .= '     Status     :  Failed' . "\n";
          $text .= '     Message    :  ' . $result->getMessage()."\n";
          break;
        case Result::STATUS_ERROR :
          $text .= '     Status     :  Error' . "\n";
          $text .= '     Message    :  ' . $result->getMessage()."\n";
          break;
        default :
      }
      $text .= "\n";
    }
    return $text;
  }
}
