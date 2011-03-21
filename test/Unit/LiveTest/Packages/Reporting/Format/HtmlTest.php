<?php

namespace Unit\LiveTest\Packages\Reporting\Format;

use LiveTest\Packages\Reporting\Format\Html;

use LiveTest\Report\Format\Csv;

use LiveTest\TestRun\Information;

use Base\Www\Uri;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Result\ResultSet;

class HtmlTest extends FormatTest
{
  private $htmlFixture = 'fixtures/htmlReport.html';

  protected function getFormat()
  {
    return new Html();
  }

  public function testFormat()
  {
    $formattedText = $this->getStandardFormattedContent();

    $expected = file_get_contents(__DIR__.'/'.$this->htmlFixture);

    $expected = preg_replace( "^<td>Date: (.*)</td>^", "<td>Date: removed for unit test</td>", $expected);
    $formattedText = preg_replace( "^<td>Date: (.*)</td>^", "<td>Date: removed for unit test</td>", $formattedText);

    $expected = preg_replace( "^<td>Duration: (.*)</td>^", "<td>Duration: removed for unit test</td>", $expected);
    $formattedText = preg_replace( "^<td>Duration: (.*)</td>^", "<td>Duration: removed for unit test</td>", $formattedText);

    $this->assertEquals($expected, $formattedText);
  }
}