<?php

namespace Unit\LiveTest\Report\Format;

use LiveTest\Report\Format\Csv;

use LiveTest\TestRun\Information;

use Base\Www\Uri;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Result\ResultSet;

class CsvTest extends FormatTest
{
  protected function getFormat()
  {
    return new Csv();
  }

  public function testFormat()
  {
    $formattedText = $this->getStandardFormattedContent();

    $expected = "http://www.example.com;TestName;TestClass;success\nhttp://www.example.com;TestName;TestClass;failure\n";

    $this->assertEquals($expected, $formattedText);
  }
}