<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

use Base\Config\Yaml;

/**
 * This tag adds a yaml formatted list of pages (external file) to the configuration.
 *
 * @example
 *  PageLists:
 *   - top100.yml
 *   - sitemap.yml
 *
 * @author Nils Langner
 */
class PageLists extends Base
{
  /**
   * @see LiveTest\Config\Tags\TestSuite.Base::doProcess()
   */
  protected function doProcess(\LiveTest\Config\TestSuite $config, $parameters)
  {
    foreach ($parameters as $file)
    {
      $yaml = new Yaml($config->getBaseDir() . '/' . $file);
      $this->getParser()->parse( $yaml->toArray( ), $config );
    }
  }
}