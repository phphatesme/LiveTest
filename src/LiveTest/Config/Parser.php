<?php

namespace LiveTest\Config;

class Parser
{
  private $configArray;
  private $config;
  private $registeredTags;

  public function __construct()
  {
    // @todo This should be done automaticly
    $this->registeredTags = array('TestSuite' => 'LiveTest\Config\Tags\TestSuite',
                                  'TestCases' => 'LiveTest\Config\Tags\TestCases',
    							  'TestCase'  => 'LiveTest\Config\Tags\TestCase',
    							  'Pages'       => 'LiveTest\Config\Tags\Pages',
    							  'IncludePages' => 'LiveTest\Config\Tags\IncludePages',
    							  'ExcludePages' => 'LiveTest\Config\Tags\ExcludePages',
    							  'PageLists' => 'LiveTest\Config\Tags\PageLists',
    							  'PageFiles' => 'LiveTest\Config\Tags\PageFiles' );
  }

  public function parse(array $configArray, Config $config)
  {
    foreach ($configArray as $configTag => $value)
    {
      if (array_key_exists($configTag, $this->registeredTags))
      {
        $tagClassName = $this->registeredTags[$configTag];
        $tag = new $tagClassName($value, $config, $this);
        $tag->process();
      }
      else
      {
        throw new \Exception('Unknown tag (' . $configTag . ')');
      }
    }

    return $config;
  }
}