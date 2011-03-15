<?php

namespace phmLabs\Components\NamedParameters;

class Functions
{
  /**
   * This function is used to call a function/method with named parameters. This means
   * the parameters are given as an associative array and will be ordered to fit the
   * function signature.
   *
   * @param call_back $function
   * @param array $param_arr
   */
  public static function call_user_func_assoc_array($function, array $param_arr = array())
  {
    $namedParameters = new NamedParameters();

    if (is_array($function))
    {
      $returnValue = $namedParameters->callMethod($function[0], $function[1], $param_arr);
    }
    else
    {
      $returnValue = $namedParameters->callFunction($function, $param_arr);
    }

    return $returnValue;
  }
}