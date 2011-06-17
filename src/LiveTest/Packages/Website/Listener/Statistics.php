<?php

namespace LiveTest\Packages\Website\Listener;

use Zend\Http\Client as ZendClient;

use Base\Http\Request\Request;
use Base\Http\Client\Zend;
use Base\Www\Uri;

use LiveTest\Config\Request\Symfony;
use LiveTest\Listener\Base;
use LiveTest\TestRun\Information;
use LiveTest\TestRun\Properties;

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
    foreach ($properties->getTestSets() as $sessionName => $testSets)
    {
      foreach ($testSets as $testSet)
      {
        {
          $count += $testSet->getTestCount();
        }
      }
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
      $request = Symfony::create(new Uri(self::PHM_API), Request::GET, array ('urls' => $this->urls, 'tests' => $this->tests));
      
      $client = new Zend();
      $response = $client->request($request);
    }
    catch (\Exception $e)
    {
    }
  }
}