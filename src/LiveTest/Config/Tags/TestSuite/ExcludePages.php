<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

/**
 * This tag excludes a list of pages.
 *
 * @example
 *  ExcludePages:
 *   - /impressum.html
 *   - http://www.example.com
 *
 * @author Nils Langner
 */

class ExcludePages extends Base
{
  /**
   * @see LiveTest\Config\Tags\TestSuite.Base::doProcess()
   */
  protected function doProcess(\LiveTest\Config\TestSuite $config, array $parameters)
  {
    $config->excludePages($parameters);
  }
}