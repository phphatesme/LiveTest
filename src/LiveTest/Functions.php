<?php

namespace LiveTest;

use Annovent\Functions as AnnoventFunctions;
use Annovent\Exception as AnnoventException;

class Functions
{
  public static function initializeObject($object, $parameter)
  {
    $result = '';

    if (method_exists($object, 'init'))
    {
      try
      {
        $result = AnnoventFunctions::call_user_func_assoc_array(array($object,'init'), $parameter);
      }
      catch ( AnnoventException $e )
      {
        throw new ConfigurationException('Unable to initialize object (' . get_class($object) . '). ' . 'Mandatory parameter "' . $e->getMissingParameter() . '" is missing.');
      }
    }

    return $result;
  }
}