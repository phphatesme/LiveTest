<?php

namespace Annovent;

function call_user_func_assoc_array($function, array $param_arr = null)
{
  if (is_array($function))
  {
    $object = $function [0];
    $method = $function [1];
    
    $reflectedListener = new \ReflectionClass($object);
    $reflectedMethod = $reflectedListener->getMethod($method);
    $parameters = $reflectedMethod->getParameters();
  }
  else
  {
    $reflectedFunction = new \ReflectionFunction($function);
    $parameters = $reflectedFunction->getParameters();
  }
  
  $orderedParameters = array ();
  
  foreach ( $parameters as $parameter )
  {
    $name = $parameter->getName();
    if (array_key_exists($name, $param_arr))
    {
      $orderedParameters [] = $param_arr [$name];
    }
    else
    {
      if (!$parameter->isOptional())
      {
        $e = new \Annovent\Exception('Parameter "' . $name . '" not set.');
        $e->setMissingParameter($name);
        throw $e;
      }
    }
  }
  return call_user_func_array($function, $orderedParameters);
}