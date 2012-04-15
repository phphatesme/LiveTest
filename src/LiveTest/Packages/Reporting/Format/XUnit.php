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
 * This format converts the results into the standard xUnit xml format for the PHPUnit adapter used by the jenkins xUnit plugin.
 *
 * @author Robert Gruber
 */
class XUnit implements Format
{
    /**
     * Formats the results into the specified xml format for the xUnit jenkins plugin configured with the PHPUnit adapter.
     *
     * @param ResultSet $set
     * @param array $connectionStatuses
     * @param Information $information
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @see https://wiki.jenkins-ci.org/x/VIBNAg
     */
    public function formatSet (ResultSet $set, array $connectionStatuses, Information $information)
    {
        $dom = new \DOMDocument('1.0', 'utf-8');

        $xmlTestsuites = $dom->createElement('testsuites');
        $dom->appendChild($xmlTestsuites);
        $xmlTestsuite = $dom->createElement('testsuite');

        $numFailed = 0;
        $numErrors = 0;

        foreach ($set as $result) {
            $xmlTestcase = $dom->createElement('testcase');

            $xmlTestcase->setAttribute('name', "{$result->getTest()->getName()} ({$result->getUri()})");
            $xmlTestcase->setAttribute('file', $result->getUri());

            if ($result->getStatus() == Result::STATUS_FAILED) {
                $xmlFailure = $dom->createElement('failure');
                $xmlFailure->setAttribute('type', $result->getStatus());
                $xmlFailure->setAttribute('message', $result->getMessage());
                $xmlTestcase->appendChild($xmlFailure);
                $numFailed++;
            }

            if ($result->getStatus() == Result::STATUS_ERROR) {
                $xmlFailure = $dom->createElement('error');
                $xmlFailure->setAttribute('type', $result->getStatus());
                $xmlFailure->setAttribute('message', $result->getMessage());
                $xmlTestcase->appendChild($xmlFailure);
                $numErrors++;
            }

            $xmlTestsuite->appendChild($xmlTestcase);
        }

        $xmlTestsuite->setAttribute('name', 'LiveTest');
        $xmlTestsuite->setAttribute('errors', $numErrors);
        $xmlTestsuite->setAttribute('failures', $numFailed);
        $xmlTestsuite->setAttribute('tests', count($set));
        $xmlTestsuite->setAttribute('time', $information->getDuration());
        $xmlTestsuites->appendChild($xmlTestsuite);

        $dom->formatOutput = true;

        return $dom->saveXML();
    }
}
