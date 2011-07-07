<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun;

use LiveTest\Connection\Session\Session;

use LiveTest\ConfigurationException;

use LiveTest\Config\Parser\UnknownTagException;

use LiveTest\Config\TestSuite;
use LiveTest\Config\Parser\Parser;

use Base\Config\Yaml;
use Base\Www\Uri;

use LiveTest\Connection\Request\LiveTest as Request;

/**
 * A properties class holds all information about a test run. It prepares athe data given by
 * a config file to be used in a test run.
 *
 * @author Nils Langner
 */
class Properties
{
  /**
   * The default domain
   * @var Uri
   */
  private $defaultDomain;
  
  /**
   * The configuration with all needed data
   * @var Config
   */
  private $config;
  
  /**
   * Array of test sets
   * @var TestSet[]
   */
  private $testSets = array ();
  
  /**
   * @param Config $config
   * @param Uri $defaultDomain
   */
  public function __construct(TestSuite $config, Uri $defaultDomain)
  {
    $this->defaultDomain = $defaultDomain;
    $this->config = $config;
    $this->initTestSets();
  }
  
  /**
   * Returns a list of sessions
   * 
   * @return Session[]
   */
  public function getSessions( )
  {
  	return $this->config->getSessions();
  }
  
  /**
   * This function converts the information given in a config file to a number of test sets.
   */  
  private function initTestSets()
  {
    $testCases = $this->config->getTestCases();
    foreach ($testCases as $testCase)
    {
      $config = $testCase['config'];
      
      $sessions = $config->getSessions();
      foreach ($sessions as $sessionName => $session)
      {
        foreach ($session->getPageRequests() as $aPageRequest)
        {
          if (!array_key_exists($sessionName, $this->testSets) || !array_key_exists($aPageRequest->getIdentifier(), $this->testSets[$sessionName]))
          {
            $this->testSets[$sessionName][$aPageRequest->getIdentifier()] = new TestSet($aPageRequest);
          }
          
          $test = new Test($testCase['name'], $testCase['className'], $testCase['parameters']);
          $this->testSets[$sessionName][$aPageRequest->getIdentifier()]->addTest($test);
        }
      }
    }
  }
  
  /**
   * Returns the default domain
   *
   * @return Uri
   */
  public function getDefaultDomain()
  {
    return $this->defaultDomain;
  }
  
  /**
   * Returns the test sets
   * 
   * @todo should be getTestSetsBySession
   * @return TestSet[]
   */
  public function getTestSets()
  {
    return $this->testSets;
  }
  
  /**
   * Assembles all properties to a string.
   * 
   * @return String Properties
   */
  public function __toString()
  {
    $testSets = $this->getTestSets();
    $propertiesString = '';
    foreach ($testSets as $testSet)
    {
      $propertiesString .= 'Uri: ' . $testSet->getUri() . "\n";
      $tests = $testSet->getTests();
      foreach ($tests as $test)
      {
        $propertiesString .= "  Test:\n";
        $propertiesString .= '    Testname : ' . $test->getName() . "\n";
        $propertiesString .= '    Classname: ' . $test->getClassName() . "\n\n";
      }
    }
    return $propertiesString;
  }
  
  /**
   * Creates a properties object that was created using a yaml file.
   *
   * @todo is this method neccessary? If yes: Where to put it? At the moment it is only used to make testing easier
   *
   * @param String $filename The file name of the yaml file
   * @param Uri $defaultUri The default uri
   */
  public static function createByYamlFile($filename, Uri $defaultUri)
  {
    try
    {
      $yamlConfig = new Yaml($filename);
    }
    catch (\Zend\Config\Exception $e)
    {
      throw new ConfigurationException('Unable to load test suite yaml file (filename: ' . $filename . ')');
    }
    
    $testSuiteConfig = new TestSuite(new Session($defaultUri, true));
    $testSuiteConfig->setBaseDir(dirname($filename));
    $testSuiteConfig->setDefaultDomain($defaultUri);
    
    $parser = new Parser('LiveTest\\Config\\Tags\\TestSuite\\');
    try
    {
      $testSuiteConfig = $parser->parse($yamlConfig->toArray(), $testSuiteConfig);      
    }
    catch (UnknownTagException $e)
    {
      throw new ConfigurationException('Error parsing testsuite configuration (' . $filename . '): ' . $e->getMessage(), null, $e);
    }
    
    return new self($testSuiteConfig, $defaultUri);
  }
}