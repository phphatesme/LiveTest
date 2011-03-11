<?php

namespace phmLabs\Components\Annovent\Annotation;

use Doctrine\Common\Annotations\Annotation;

class Event extends Annotation
{
  public $value;

  public function getNames()
  {
    return (array)$this->value;
  }
}