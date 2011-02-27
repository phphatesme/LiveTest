<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun;

use Base\Www\Uri;

/**
 * This class contains all information about a test run.
 *
 * @author Nils Langner
 */
class Information
{
  /**
   * The duration of the test run in seconds
   * @var int
   */
  private $duration;

  /**
   * The default domain the test run was run against.
   * @var Uri
   */
  private $defaultDomain;

  public function __construct($duration, Uri $defaultDomain )
  {
    $this->duration = $duration;
    $this->defaultDomain = $defaultDomain;
  }

  /**
   * Returns the default domain.
   *
   * @return Uri
   */
  public function getDefaultDomain( )
  {
    return $this->defaultDomain;
  }

  /**
   * Returns the duration of the test run.
   *
   * @return int
   */
  public function getDuration()
  {
    return $this->duration;
  }
}