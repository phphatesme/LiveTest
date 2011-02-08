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
  
  public function __construct( Writer $writer, Format $format, ResultSet $resultSet, $connectionStatuses, Information $information )
  {
    $this->writer = $writer;
    $this->format = $format;
    $this->resultSet = $resultSet;
    $this->information = $information;
    $this->connectionStatuses = $connectionStatuses;
  }
  
  public function render( )
  {
    $content = $this->format->formatSet($this->resultSet, $this->connectionStatuses, $this->information);
    $this->writer->write($content);
  }
}