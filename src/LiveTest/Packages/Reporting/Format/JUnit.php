<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Reporting\Format;

use LiveTest\TestRun\Result\Result;

use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Information;
use LiveTest\TestRun\Result\ResultSet;

/**
 * This format converts the results into the standard jUnit xml format.
 *
 * @author Nils Langner & Sven Paulus
 */
class JUnit implements Format
{
  private $dom;

  /**
   * Formats the results into the jUnit xml format.
   *
   * @param ResultSet $set
   * @param array $connectionStatuses
   * @param Information $information
   *
   * @return string
   */
  public function formatSet(ResultSet $set, array $connectionStatuses, Information $information)
  {
    $dom = new \DOMDocument('1.0', 'utf-8');

    $xml_testsuites = $dom->createElement('testsuites');
    $dom->appendChild($xml_testsuites);
    $xml_testsuite = $dom->createElement('testsuite');
    $xml_properties = $dom->createElement('properties');
    $xml_testsuite->appendChild($xml_properties);

    $num_failed = 0;
    $num_errors = 0;

    foreach ( $set as $result )
    {
      $xml_testcase = $dom->createElement('testcase');

      $xml_testcase->setAttribute('name', $result->getTest()->getName());
      $xml_testcase->setAttribute('file', $result->getUri());

      if ($result->getStatus() == Result::STATUS_FAILED)
      {
        $xml_failure = $dom->createElement('failure');
        $xml_failure->setAttribute('type', $result->getStatus());
        $xml_failure->setAttribute('message', $result->getMessage());
        $xml_testcase->appendChild($xml_failure);
        $num_failed++;
      }

      if ($result->getStatus() == Result::STATUS_ERROR)
      {
        $xml_failure = $dom->createElement('error');
        $xml_failure->setAttribute('type', $result->getStatus());
        $xml_failure->setAttribute('message', $result->getMessage());
        $xml_testcase->appendChild($xml_failure);
        $num_errors++;
      }

      $xml_testsuite->appendChild($xml_testcase);
    }

    $xml_testsuite->setAttribute('name', 'LiveTest');
    $xml_testsuite->setAttribute('errors', $num_errors);
    $xml_testsuite->setAttribute('failures', $num_failed);
    $xml_testsuite->setAttribute('tests', count($set));
    $xml_testsuite->setAttribute('timestamp', strftime("%Y-%m-%dT%H:%M:%S"));
    $xml_testsuites->appendChild($xml_testsuite);

    $dom->formatOutput = true;
    return $dom->saveXML();
  }
}