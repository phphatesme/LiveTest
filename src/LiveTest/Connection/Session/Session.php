<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Connection\Session;

use LiveTest\Connection\Request\Request;

use Base\Www\Uri;

/**
 * This class contains all information about the tests and the depending pages.
 *
 * @author Nils Langner
 */
use LiveTest\Config\PageManipulator\PageManipulator;

class Session
{
  private $pageRequests = array ();
  private $allowCookies;
  
  public function __construct($allowCookies = false)
  {
    $this->allowCookies = $allowCookies;
  }
  
  public function includePageRequest(Request $pageRequest)
  {
    $this->pageRequests[] = $pageRequest;
  }
  
  public function includePageRequests(array $pageRequests)
  {
    foreach ($pageRequests as $pageRequest)
    {
      $this->includePageRequest($pageRequest);
    }
  }
  
  public function getPageRequests()
  {
    return $this->pageRequests;
  }
  
  public function areCookiesAllowed()
  {
    return $this->allowCookies;
  }
}

class SessionOld
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
   * @var Session
   */
  private $parentSession;
  
  /**
   * The default domain
   * @var Uri $defaultDomain
   */
  private $defaultDomain = null;
  
  private $isolateRequests;
  
  public function __construct(Uri $defaultDomain, $isolateRequests = false)
  {
    $this->defaultDomain = $defaultDomain;
    $this->isolateRequests = $isolateRequests;
  }
  
  public function createChildSession()
  {
    $childSession = new self($this->defaultDomain, $this->isolateRequests);
    $childSession->setParentSession($this);
    return $childSession;
  }
  
  private function setParentSession(Session $session)
  {
    $this->parentSession = $session;
  }
  
  /**
   * Returns true if every request should be fired isolated.
   *
   * @return bool
   */
  public function areRequestsIsolated()
  {
    return $this->isolateRequests;
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
    foreach ($pageRequests as $aPageRequest)
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
    foreach ($pageRequests as $aPageRequest)
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
    if ($this->inherit && ! is_null($this->parentSession))
    {
      $results = array_merge($this->includedPageRequests, $this->parentSession->getPageRequests());
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
    foreach ($excludedPageRequests as $identifier => $pageRequest)
    {
      if (array_key_exists($identifier, $includedPageRequest))
      {
        unset($includedPageRequest[$identifier]);
      }
    }
    return $includedPageRequest;
  }
}