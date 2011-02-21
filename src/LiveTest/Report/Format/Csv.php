<?php

namespace LiveTest\Report\Format;

use LiveTest\TestRun\Information;

use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

class Csv implements Format
{
  public function formatSet(ResultSet $set, array $connectionStatuses, Information $information)
  {
    $text = '';
    foreach ( $set->getResults() as $result )
    {
      $test = $result->getTest();

      $text .= $result->getUri() . ";".$test->getName().";".$test->getClassName().";"
               . $result->getStatus()."\n";
    }
    return $text;
  }
}
