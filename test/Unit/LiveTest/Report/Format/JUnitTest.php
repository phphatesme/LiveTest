<?php

namespace Unit\LiveTest\Report\Format;

use LiveTest\Report\Format\JUnit;

class JUnitTest extends FormatTest
{
  protected function getFormat()
  {
    return new JUnit();
  }

  public function testFormat()
  {
    $formattedText = $this->getStandardFormattedContent();
    $expected = file_get_contents(__DIR__.'/fixtures/junit.xml');

    $pattern = '^timestamp="(.*)"^';
    $formattedText = preg_replace($pattern, 'timestamp=""', $formattedText);

    $pattern = '^timestamp="(.*)"^';
    $expected = preg_replace($pattern, 'timestamp=""', $expected);

    $this->assertEquals($expected, $formattedText);
  }
}
