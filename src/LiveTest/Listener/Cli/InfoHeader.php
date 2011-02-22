<?php

namespace LiveTest\Listener\Cli;

use LiveTest\Listener\Base;
use LiveTest\TestRun\Properties;

/**
 * This listener echoes the run information before the test start.
 *
 * @author Nils Langner
 */
class InfoHeader extends Base
{
  /**
   * This function echoes the default domian, start time, number of uri and number of tests.
   *
   * @event LiveTest.Run.PreRun
   *
   * @param Properties $properties
   */
  public function preRun(Properties $properties)
  {
    echo "  Default Domain  : " . $properties->getDefaultDomain()->toString()."\n";
    echo "  Start Time      : " . date( 'Y-m-d H:i:s' )."\n\n";
    echo "  Number of URIs  : " . count($properties->getTestSets())."\n";
    echo "  Number of Tests : " . $this->getTotalTestCount($properties)."\n\n";
  }

  /**
   * This function returns the total number of tests defined in a given properties object.
   *
   * @param Properties $properties
   */
  private function getTotalTestCount(Properties $properties)
  {
    $count = 0;
    foreach ($properties->getTestSets() as $testSet)
    {
      $count += $testSet->getTestCount();
    }
    return $count;
  }
}