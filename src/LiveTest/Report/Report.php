<?php

namespace LiveTest\Report;

use LiveTest\TestRun\Information;

use LiveTest\Report\Writer\Writer;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\Report\Format\Format;

class Report
{
  private $writer;
  private $format;
  private $resultSet;
  private $connectionStatuses;
  private $information;
  
  /**
   * @param Writer $writer
   * @param Format $format
   * @param ResultSet $resultSet
   * @param array $connectionStatuses
   * @param Information $information
   */
  public function __construct( Writer $writer, 
                               Format $format, 
                               ResultSet $resultSet, 
                               array $connectionStatuses, 
                               Information $information )
  {
    $this->writer = $writer;
    $this->format = $format;
    $this->resultSet = $resultSet;
    $this->information = $information;
    $this->connectionStatuses = $connectionStatuses;
  }
  
  /**
   * Renders the report.
   */
  public function render( )
  {
    $content = $this->format->formatSet($this->resultSet, $this->connectionStatuses, $this->information);
    $this->writer->write($content);
  }
}