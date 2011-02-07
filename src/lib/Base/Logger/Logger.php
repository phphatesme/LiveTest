<?php

namespace Base\Logger;

interface Logger
{
  public function log($message, $severity);
}