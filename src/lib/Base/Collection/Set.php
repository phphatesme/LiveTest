<?php

namespace Base\Collection;

class Set implements \Iterator, \Countable
{
  private $position = 0;
  private $elements = array ();

  public function __construct()
  {
    $this->position = 0;
  }

  protected function addElement( $element )
  {
    $this->elements[] = $element;
  }

  public function count( )
  {
    return count($this->elements);
  }

  public function rewind()
  {
    $this->position = 0;
  }

  public function current()
  {
    return $this->elements[$this->position];
  }

  public function key()
  {
    return $this->position;
  }

  public function next()
  {
    ++$this->position;
  }

  public function valid()
  {
    return isset($this->elements[$this->position]);
  }
}