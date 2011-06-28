<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\TestSuite;
use Base\Www\Uri;

/**
 * This tag is used to set the default domain.
 *
 * @example
 *  DefaultDomain: http://www.phphatesme.com
 *
 * @author Nils Langner
 */
class DefaultDomain extends Base
{
  /**
   * @see LiveTest\Config\Tags\Config.Base::doProcess()
   */
  protected function doProcess(TestSuite $config, $parameters)
  {
  	var_dump( $parameters);
//    $config->setDefaultDomain(new Uri($parameters));
  }
}