<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\Parser;

/**
 * This tag does nothing but skipping the root test suite tag.
 *
 * @author Nils Langner
 */
class TestSuite extends Base
{
  /**
   * @see LiveTest\Config\Tags\TestSuite.Base::doProcess()
   */
  protected function doProcess(\LiveTest\Config\TestSuite $config, array $parameters)
  {
    $this->getParser()->parse($parameters, $config);
  }
}