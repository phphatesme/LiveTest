<?php

namespace Base\Logger;

class NullLogger implements Logger
{
  public function log($message, $severity)
  {
  
  }
}