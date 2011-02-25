<?php

namespace LiveTest\Config;

class Parser
{
  public function parse(array $configArray, Config $config)
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
        throw new \Exception('Unknown tag (' . $configTag . ')');
      }
    }

    return $config;
  }

  private function getTagClassName($tag)
  {
    if (strpos($tag, '\\') === false)
    {
      $className = 'LiveTest\\Config\\Tags\\' . $tag;
    }
    else
    {
      $className = $tag;
    }
    return $className;
  }
}