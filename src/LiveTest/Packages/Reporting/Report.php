<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Reporting;

use LiveTest\TestRun\Information;

use LiveTest\Packages\Reporting\Writer\Writer;
use LiveTest\Packages\Reporting\Format\Format;
use LiveTest\TestRun\Result\ResultSet;

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