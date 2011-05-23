<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config;

use Base\Www\Uri;

use Base\Http\Request\Request;

/**
 * This class contains all information about the tests and the depending pages.
 *
 * @author Nils Langner
 */
use LiveTest\Config\PageManipulator\PageManipulator;

class TestSuite implements Config
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
   * The created tests.
   * @var array
   */
  private $testCases = array ();

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

  private $pageManipulators = array ();

  /**
   * Set the parent config if needed.
   *
   * @param TestSuite $parentConfig
   */
  public function __construct(TestSuite $parentConfig = null)
  {
    $this->parentConfig = $parentConfig;
  }

  /**
   * Used to add a page manipulator. These manipulators are used to manipulate the
   * pages (url strings) registered in this config file.

   * @param PageManipulator $pageManipulator
   */
  public function addPageManipulator(PageManipulator $pageManipulator)
  {
    $this->pageManipulators[] = $pageManipulator;
  }

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
   *
   * gets the base domain
   * @return Uri $defaultDomain
   */
  public function getDefaultDomain()
  {
    return $this->defaultDomain;
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
   * This function adds a test to the config and returns a new config connected to the
   * test.
   *
   * @todo we should use the Test class for this
   *
   * @param string $name
   * @param string $className
   * @param array $parameters
   */
  public function createTestCase($name, $className, array $parameters)
  {
    $config = new self($this);

    $this->testCases[] = array ('config' => $config, 'name' => $name, 'className' => $className, 'parameters' => $parameters );

    return $config;
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
      $results = array_merge_recursive($this->includedPageRequests, $this->parentConfig->getPageRequests());
    }
    else
    {
      $results = $this->includedPageRequests;
    }

    $pageRequests = $this->getReducedPageRequests($results, $this->excludedPageRequests);

    foreach( $this->pageManipulators as $manipulator )
    {
      foreach( $pageRequests as &$pageRequest )
      {
        $pageRequest = $manipulator->manipulate($pageRequest);
      }
    }

    return $pageRequests;
  }

  private function getReducedPageRequests(array $includedPageRequest, array $excludedPageRequests)
  {
     foreach($excludedPageRequests as $urlKey => $pageRequest)
      {
        if(array_key_exists($urlKey, $includedPageRequest))
        {
          unset($includedPageRequest[$urlKey]);
        }
      }

      return $includedPageRequest;
  }

  /**
   * Returns the tests.
   *
   * @return array
   */
  public function getTestCases()
  {
    return $this->testCases;
  }
}