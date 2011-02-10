<?php

namespace Base\Collection;

class Set implements \Iterator
{
  private $parameters = array();
  private $currentElement;
  
  public function add($key, $value)
  {
    $this->parameters[$key] = $value;
  }
  
  public function addSet($key, Set $set)
  {
    $this->parameters[$key] = $set;
  }
  
  public function has($key)
  {
    return array_key_exists($key, $this->parameters);
  }
  
  public function hasSet(Set $set)
  {
  
  }
  
  public function get($key)
  {
    if (!$this->has($key))
    {
      // @todo use special exception
      throw new \Exception('parameter not found');
    }
    return $this->parameters[$key];
  }
  
  public function size()
  {
    return count($this->parameters);
  }
  
  public function current()
  {
    return current($this->parameters);
  }
  
  public function key()
  {
    return key($this->parameters);
  }
  
  public function next()
  {
    return next($this->parameters);
  }
  
  public function rewind()
  {  
  }
  
  public function valid()
  {
  }
}