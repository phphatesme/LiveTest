<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Connection\Request\Symfony as Request;

/**
 * This tag is used to add a list (text file) of pages to the configuration.
 *
 * @example
 * PageFiles:
 *  - top100.txt
 *  - sitemap.txt
 *
 * @author Nils Langner
 */
class PageFiles extends Base
{
  /**
   * @see LiveTest\Config\Tags\TestSuite.Base::doProcess()
   */
  protected function doProcess(\LiveTest\Config\TestSuite $config, $parameters)
  {
    $config->getCurrentSession()->doNotInherit();
    foreach ($parameters as $file)
    {
      $config->getCurrentSession()->includePageRequests(Request::createRequestsFromParameters(file($config->getBaseDir() . '/' . $file), $config->getDefaultDomain()));
    }
  }
}