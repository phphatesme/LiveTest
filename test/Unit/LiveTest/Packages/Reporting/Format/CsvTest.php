<?php

namespace Unit\LiveTest\Packages\Reporting\Format;

use LiveTest\Packages\Reporting\Format\Csv;

class CsvTest extends FormatTest
{
  protected function getFormat()
  {
    return new Csv();
  }

  public function testFormat()
  {
    $formattedText = $this->getStandardFormattedContent();

    $expected = "http://www.example.com;TestName;TestClass;success\nhttp://www.example.com;TestName;TestClass;failure\nhttp://www.example.com;TestName;TestClass;error\n";

    $this->assertEquals($expected, $formattedText);
  }
}
