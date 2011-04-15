<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Parser;

use LiveTest\Config\Config;

/**
 * LiveTest configuration files consist of tags. All these tags can be interpreted
 * and a special operation can be done, when processing this tag. This parser is
 * used to handle these tags and to create the configuration.
 *
 * @author Nils Langner
 */
class Parser
{
  private $standardNameSpace;

  /**
   * Sets the standard namespace. The namespace is used to find first level tags. It
   * is also used to differ between user space and kernel space.
   *
   * @param string $standardNameSpace
   */
  public function __construct($standardNameSpace)
  {
    $this->standardNameSpace = $standardNameSpace;
  }

  /**
   * Parses a given array into a config object
   *
   * @param array $configArray
   * @param Config $config
   * @throws Exception
   */
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
        throw new UnknownTagException('Unknown tag (' . $configTag . ')', $configTag);
      }
    }

    return $config;
  }

  /**
   * Returns the class name of a given tag. Differs between user and kernel space.
   *
   * @param string $tag
   */
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