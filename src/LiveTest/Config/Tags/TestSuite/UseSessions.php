<?php

namespace LiveTest\Config\Tags\TestSuite;

/**
 * This tag sets a list of pages to the configuration and stops the inheritance of the config file. If
 * you want to inherit use the IncludePages tag.
 *
 * @example
 * Pages:
 * - /
 * - http://www.example.com
 *
 * @author Nils Langner
 */
class UseSessions extends Base
{
  protected function doProcess(\LiveTest\Config\TestSuite $config, $sessionNames)
  {
    $testCaseConfig = $config->getCurrentTestCaseConfig();
    foreach ($sessionNames as $sessionName)
    {
      $testCaseConfig->addSession($sessionName);
    }
  }
}