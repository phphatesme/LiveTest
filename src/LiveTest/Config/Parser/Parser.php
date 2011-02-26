<?php

namespace LiveTest\Config\Parser;

use LiveTest\Config\Configuration;

class Parser
{
  private $standardNameSpace;
  
  public function __construct($standardNameSpace)
  {
    $this->standardNameSpace = $standardNameSpace;
  }
  
  public function parse(array $configArray, Configuration $config)
  {
    foreach ($configArray as $configTag => $value)
    {
      $tagClassName = $this->getTagClassName($configTag);
      if (class_exists($tagClassName))
      {
        $tag = new $tagClassName($value, $config, $this);
        $tag->process();
      }
      else
      {
        throw new Exception('Unknown tag (' . $configTag . ')');
      }
    }

    return $config;
  }

  private function getTagClassName($tag)
  {
    if (strpos($tag, '_') === false)
    {
      $className = $this->standardNameSpace . $tag;
    }
    else
    {
      $className = $tag;
    }
    return $className;
  }
}