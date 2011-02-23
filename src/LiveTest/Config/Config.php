<?php

namespace LiveTest\Config;

class Config
{
  private $includedPages = array();
  private $excludedPages = array();

  private $testCases = array();
  private $inherit = true;

  private $baseDir;

  private $parentConfig;

  public function __construct(Config $parentConfig = null)
  {
    $this->parentConfig = $parentConfig;
  }

  public function setBaseDir($baseDir)
  {
    $this->baseDir = $baseDir;
  }

  public function getBaseDir()
  {
    if (is_null($this->baseDir))
    {
      return $this->parentConfig->getBaseDir();
    }
    return $this->baseDir;
  }

  public function includePage($page)
  {
    $this->includedPages[$page] = $page;
  }

  public function includePages($pages)
  {
    foreach( $pages as $page )
    {
      $this->includePage(trim($page));
    }
  }

  public function excludePage($page)
  {
    $this->excludedPages[$page] = $page;
  }

  public function doNotInherit()
  {
    $this->inherit = false;
  }

  public function clearPages()
  {
    $this->includedPages = array();
    $this->excludedPages = array();
  }

  public function createTestCase($name, $className, $parameters)
  {
    $config = new self($this);

    $this->testCases[] = array('config' => $config,'className' => $className,'parameters' => $parameters);

    return $config;
  }

  public function getPages()
  {
    if ($this->inherit && !is_null($this->parentConfig))
    {
      $result = array_merge($this->includedPages, $this->parentConfig->getPages());
    }
    else
    {
      $result = $this->includedPages;
    }

    return array_diff($result, $this->excludedPages);
  }

  public function getTestCases()
  {
    return $this->testCases;
  }
}