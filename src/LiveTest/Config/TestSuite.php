<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config;

use LiveTest\ConfigurationException;

use LiveTest\Connection\Session\Session;

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
   * The created tests.
   * @var array
   */
  private $testCases = array ();
  
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
  
  private $sessions = array ();
  
  private $currentSession;
  private $defaultSession;
  
  const DEFAULT_SESSION = '_DEFAULT';
  
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
  public function __construct(Session $defaultSession, TestSuite $parentConfig = null)
  {
    $this->parentConfig = $parentConfig;
    $this->sessions[self::DEFAULT_SESSION] = $defaultSession;
    $this->currentSession = $defaultSession;
    $this->defaultSession = $defaultSession;
  }
  
  public function getNewSession($sessionName, $isCurrentSession = true)
  {
    $session = new Session($this->getDefaultDomain());
    $this->sessions[$sessionName] = $session;
    if ($isCurrentSession)
    {
      $this->currentSession = $session;
    }
    return $session;
  }
  
  public function hasSession($sessionName)
  {
    return array_key_exists($sessionName, $this->sessions);
  }
  
  public function setCurrentSessions($sessionName)
  {
    if (!$this->hasSession($sessionName))
    {
      throw new ConfigurationException('The session you are trying to access is not available (' . $sessionName . ').');
    }
    $this->currentSession = $this->sessions[$sessionName];
  }
  
  /**
   * @todo ->getSessionContainer->getCurrentSession( )
   * @todo SessionContainer implements Iteratable
   */
  public function getCurrentSession()
  {
    return $this->currentSession;
  }
  
  public function switchToDefaultSession()
  {
    $this->currentSession = $this->defaultSession;
  }
  
  public function getSessions()
  {
    $parentSessions = array ();
    if (!is_null($this->parentConfig))
    {
      $parentSessions = $this->parentConfig->getSessions();
    }
    return array_merge($this->sessions, $parentSessions);
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
   * Sets the base domain
   * 
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
    $config = new self($this->defaultSession, $this);
    
    $this->testCases[] = array ('config' => $config, 'name' => $name, 'className' => $className, 'parameters' => $parameters);
    
    return $config;
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