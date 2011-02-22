<?php

namespace Unit\LiveTest\Report\Format;

use LiveTest\Report\Format\Csv;

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