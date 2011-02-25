<?php

namespace Base;

function firstNotNull()
{
  $arguments = func_get_args();

  foreach ($arguments as $key => $argument )
  {
    if (!is_null($argument))
    {
      return $argument;
    }
  }
  return null;
}