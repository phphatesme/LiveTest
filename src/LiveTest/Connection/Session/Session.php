<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Connection\Session;

use LiveTest\Config\Request\Request;

use Base\Www\Uri;
use Base\Http\Request\Request;

/**
 * This class contains all information about the tests and the depending pages.
 *
 * @author Nils Langner
 */
use LiveTest\Config\PageManipulator\PageManipulator;

class Session
{
  /**
   * Pages that are included
   * @var array[]
   */
  private $includedPageRequests = array ();

  /**
   * PageRequests that are excluded
   * @var array[]
   */
  private $excludedPageRequests = array ();

  /**
   * This flag indicates if this config file should inherit the pages from its
   * parent.
   *
   * @var bool
   */
  private $inherit = true;

  /**
   * The directory of the yaml file this configuration was created from
   * @var string
   */
  private $baseDir;

  /**
   * The parent configuration. Used to inherit pages.
   * @var TestSuite
   */
  private $parentConfig;

  /**
   *
   * The default domain
   * @var Uri $defaultDomain
   */
  private $defaultDomain = null;

  /**
   * Sets the base dir. This is needed because some tags need the path to the config
   * entry file.
   *
   * @param string $baseDir
   */
  public function setBaseDir($baseDir)
  {
    $this->baseDir = $baseDir;
  }

  /**
   *
   * sets the base domain
   * @param Uri $domain
   */
  public function setDefaultDomain(Uri $domain)
  {
    $this->defaultDomain = $domain;
  }

  /**
   * Returns the base directory of the config file.
   *
   * @return string
   */
  public function getBaseDir()
  {
    if (is_null($this->baseDir))
    {
      return $this->parentConfig->getBaseDir();
    }
    return $this->baseDir;
  }

  /**
   * Include an additional page to the config.
   *
   * @param string $page
   */
  public function includePageRequest(Request $pageRequest)
  {
    $this->includedPageRequests[$pageRequest->getIdentifier()] = $pageRequest;
  }

  /**
   * Includes an array containing pages to the config.
   *
   * @param array[] $pageRequests
   */
  public function includePageRequests(array $pageRequests)
  {
    foreach ( $pageRequests as $aPageRequest )
    {
      $this->includePageRequest($aPageRequest);
    }
  }

  /**
   * Removes a page from the config.
   *
   * @param string $page
   */
  public function excludePageRequest(Request $pageRequest)
  {
    $this->excludedPageRequests[$pageRequest->getIdentifier()] = $pageRequest;
  }

  /**
   * Removes a set of pageRequests from this config.
   *
   * @param array[] $pageRequests
   */
  public function excludePageRequests($pageRequests)
  {
    foreach ( $pageRequests as $aPageRequest )
    {
      $this->excludePageRequest($aPageRequest);
    }
  }

  /**
   * This function is called if this config should not inherit the pages from its parent.
   */
  public function doNotInherit()
  {
    $this->inherit = false;
  }

  /**
   * Returns the list of pages.
   *
   * @return array[]
   */
  public function getPageRequests()
  {

    if ($this->inherit && !is_null($this->parentConfig))
    {
      $results = array_merge($this->includedPageRequests, $this->parentConfig->getPageRequests());
    }
    else
    {
      $results = $this->includedPageRequests;
    }

    $pageRequests = $this->getReducedPageRequests($results, $this->excludedPageRequests);

    return $pageRequests;
  }

  private function getReducedPageRequests(array $includedPageRequest, array $excludedPageRequests)
  {
     foreach($excludedPageRequests as $identifier => $pageRequest)
      {
        if(array_key_exists($identifier, $includedPageRequest))
        {
          unset($includedPageRequest[$identifier]);
        }
      }

      return $includedPageRequest;
  }
}