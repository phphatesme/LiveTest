<?php

namespace phmLabs\Components\NamedParameters;

/**
 * This class is used to call a function/method with named parameters. This means
 * the parameters are given as an associative array and will be ordered to fit the
 * function signature.
 *
 * @todo add unit tests
 *
 * @author Nils Langner <langner@phmlabs.com>
 * @link http://www.phmlabs.com/Components/NamedParameters
 */
class NamedParameters
{
  /**
   * This function calls a function with the given parameters
   *
   * @param string $functionName
   * @param array $parameters
   *
   * @return mixed
   */
  public function callFunction($functionName, array $parameters = array())
  {
    $reflectedFunction = new \ReflectionFunction($functionName);
    $functionParameters = $reflectedFunction->getParameters();
    $orderedParameters = $this->getOrderedParameters($functionParameters, $parameters);
    return $this->callUserFunc($functionName, $orderedParameters);
  }

  /**
   * This function calls a method with the given parameters
   *
   * @param Object $object
   * @param string $method
   * @param array $parameters
   *
   * @return mixed
   */
  public function callMethod($object, $method, array $parameters = array())
  {
    $reflectedListener = new \ReflectionClass($object);
    $reflectedMethod = $reflectedListener->getMethod($method);
    $methodParameters = $reflectedMethod->getParameters();
    $orderedParameters = $this->getOrderedParameters($methodParameters, $parameters);

    $finalParameters = $orderedParameters;
    $finalParameters[] = $parameters;
    return $this->callUserFunc(array ($object, $method), $finalParameters);
  }

  /**
   * This function calls the native call_user_func_array function.
   *
   * @param callback $function
   * @param parameters $orderedParameters
   */
  private function callUserFunc($function, $orderedParameters)
  {
    return call_user_func_array($function, $orderedParameters);
  }

  /**
   * This function returns the list of the ordared parameters
   *
   * @param array $functionParameters The paramaters the function expects $functionParameters
   * @param string $actualParameters The given parameters
   */
  private function getOrderedParameters($functionParameters, array $actualParameters = array())
  {
    $orderedParameters = array();
    foreach ( $functionParameters as $parameter )
    {
      $name = $parameter->getName();
      if (array_key_exists($name, $actualParameters))
      {
        $orderedParameters[] = $actualParameters[$name];
      }
      else
      {
        if (!$parameter->isOptional())
        {
          $e = new Exception('Mandatory parameter "' . $name . '" not set.');
          $e->setMissingParameter($name);
          throw $e;
        }
        else
        {
          $orderedParameters[] = $parameter->getDefaultValue();
        }
      }
    }
    return $orderedParameters;
  }
}