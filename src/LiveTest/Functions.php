<?php

namespace LiveTest;

class Functions
{
  public static function initializeObject($object, $parameter)
  {
    $result = '';

    if (method_exists($object, 'init'))
    {
      try
      {
        $result =\Annovent\call_user_func_assoc_array(array($object,'init'), $parameter);
      }
      catch (\Annovent\Exception $e )
      {
        throw new \LiveTest\ConfigurationException('Unable to initialize object (' . get_class($object) . '). ' . 'Mandatory parameter "' . $e->getMissingParameter() . '" is missing.');
      }
    }

    return $result;
  }
}