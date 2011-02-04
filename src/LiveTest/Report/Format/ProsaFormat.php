<?php

namespace LiveTest\Report\Format;

use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

class ProsaFormat implements Format
{
  public function formatSet(ResultSet $set)
  {
    $text = '';
    foreach ( $set->getResults() as $result )
    {
      $test = $result->getTest();
      
      switch ($result->getStatus())
      {
        case Result::STATUS_SUCCESS :
          $text .= 'Der Test "' . $test->getName() . '" (' . $test->getClass() . ') wurde erfolreich ausgeführt.' . "\n";          
          break;
        case Result::STATUS_FAILED :
          $text .= 'Der Test "' . $test->getName() . '" (' . $test->getClass() . ') wurde nicht erfolreich ausgeführt.' . "\n";
          break;
        case Result::STATUS_ERROR :
          $text .= 'Beim Ausführen des Tests "' . $test->getName() . '" (' . $test->getClass() . ') ist leider ein Fehler aufgetreten.' . "\n";
          break;
        default:   
      }    
      $text .= ' - '.$result->getMessage()."\n\n";
    }
    return $text;
  }
}