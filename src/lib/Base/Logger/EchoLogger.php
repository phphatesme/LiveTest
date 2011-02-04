<?php

namespace Base\Logger;

class EchoLogger implements Logger
{
  public function log($message, $severity)
  {
    echo $message;
  }
}