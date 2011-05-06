<?php

namespace LiveTest\Packages\Website\Listener;

use LiveTest\TestRun\Information;
use LiveTest\TestRun\Properties;
use LiveTest\Listener\Base;

use Base\Http\Client\Zend;

class Statistics extends Base
{
  private $urls;
  private $tests;

  const PHM_API = 'http://livetest.phmlabs.com/api/statistics.php';

  /**
   * @Event("LiveTest.Run.PreRun")
   * @param Properties $properties
   */
  public function preRun(Properties $properties)
  {
    $this->urls = count($properties->getTestSets());
    $this->tests = $this->getTotalTestCount($properties);
  }

  /**
   * @param Properties $properties
   */
  private function getTotalTestCount(Properties $properties)
  {
    $count = 0;
    foreach ( $properties->getTestSets() as $testSet )
    {
      $count += $testSet->getTestCount();
    }
    return $count;
  }

  /**
   * @Event("LiveTest.Run.PostRun")
   *
   * @param Information $information
   */
  public function postRun(Information $information)
  {
    try
    {
      $client = new Zend(self::PHM_API . '?urls=' . $this->urls . '&tests=' . $this->tests);
      $response = $client->request();
    }
    catch (\Exception $e )
    {
    }
  }
}