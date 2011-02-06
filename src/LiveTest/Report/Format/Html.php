<?php

namespace LiveTest\Report\Format;

use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

class Html implements Format
{
  private $content;
  private $cssFile;
  
  public function __construct($params)
  {
    $this->cssFile = $params->css_file;
  }
  
  private function createHeader()
  {
    $this->content .= "<html><head><title>LiveTest - Html Report</title></head><link rel=\"stylesheet\" media=\"all\" type=\"text/css\" href=\"".$this->cssFile."\" /><body>";
  }
  
  private function createCopyright()
  {
    $this->content .= '<div id="copyright">Html Report by <a href="http://livetest.phphatesme.com">LiveTest</a></div>';
  }
  
  private function createFooter()
  {
    $this->createCopyright();
    $this->content .= "</body></html>";
  }
  
  public function formatSet(ResultSet $set)
  {
    $this->createHeader();
    
    $matrix = array ();
    $tests = array ();
    
    foreach ( $set->getResults() as $result )
    {
      // @var $result \LiveTest\TestRun\Result\Result
      $matrix [$result->getUrl()] [$result->getTest()->getName()] = $result;
      $tests [$result->getTest()->getName()] = $result->getTest();
    }
    
    $this->content .= "<table id=\"result_table\"><tr><td></td>";
    foreach ( $tests as $test )
    {
      $this->content .= '<td><b>' . $test->getName() . '</b><br />' . $test->getClass() . '</td>';
    }
    
    foreach ( $matrix as $url => $testList )
    {
      $this->content .= '<tr><td>' . $url . '</td>';
      foreach ( $tests as $test )
      {
        if (array_key_exists($test->getName(), $testList ))
        {
          $curResult =  $testList [$test->getName()];
          $status = $curResult->getStatus();
          switch ($status)
          {
            case Result::STATUS_SUCCESS :
              $statusName = 'success';
              $message = '';
              break;
            case Result::STATUS_FAILED :
              $statusName = 'failed';
              $message = $curResult->getMessage();
              break;
            case Result::STATUS_ERROR :
              $statusName = 'error';
              $message = $curResult->getMessage();
              break;
          }
        }else{
          $statusName = 'none';
          $message = ''; 
        }
          $this->content .= '<td class="result_' . $statusName . '">' . $message . '</td>';
      }
      $this->content .= '</tr>';
    }
    
    $this->createFooter();
    
    return $this->content;
  }
}
