<?php

namespace phmLabs\Components\Annovent\Event;

class Event implements EventInterface
{
  protected $processed = false;
  protected $name;
  protected $parameters;

  /**
   * Constructs a new Event.
   *
   * @param string  $name         The event name
   * @param array   $parameters   An array of parameters
   */
  public function __construct($name, array $parameters = array())
  {
    $this->name = $name;

    foreach ($parameters as $key => $value)
    {
      $this->set($key, $value);
    }
  }

  /**
   * Returns the event name.
   *
   * @return string The event name
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Sets the processed flag to true.
   *
   * This method must be called by listeners when
   * it has processed the event (it is only meaningful
   * when the event has been notified with the notifyUntil()
   * dispatcher method.
   */
  public function setProcessed()
  {
    $this->processed = true;
  }

  /**
   * Returns whether the event has been processed by a listener or not.
   *
   * This method is only meaningful for events notified
   * with notifyUntil().
   *
   * @return Boolean true if the event has been processed, false otherwise
   */
  public function isProcessed()
  {
    return $this->processed;
  }

  /**
   * Returns the event parameters.
   *
   * @return array The event parameters
   */
  public function all()
  {
    return $this->parameters;
  }

  /**
   * Returns true if the parameter exists.
   *
   * @param  string  $name  The parameter name
   *
   * @return Boolean true if the parameter exists, false otherwise
   */
  public function has($name)
  {
    return array_key_exists($name, $this->parameters);
  }

  /**
   * Returns a parameter value.
   *
   * @param  string  $name  The parameter name
   *
   * @return mixed  The parameter value
   *
   * @throws \InvalidArgumentException When parameter doesn't exists for this event
   */
  public function get($name)
  {
    if (!array_key_exists($name, $this->parameters))
    {
      throw new \InvalidArgumentException(sprintf('The event "%s" has no "%s" parameter.', $this->name, $name));
    }

    return $this->parameters[$name];
  }

  /**
   * Sets a parameter.
   *
   * @param string  $name   The parameter name
   * @param mixed   $value  The parameter value
   */
  public function set($name, $value)
  {
    if (strtolower($name) === 'event')
    {
      throw new \InvalidArgumentException('It is not allowed to name a parameter "event" as this is a reserved word.');
    }
    $this->parameters[$name] = $value;
  }

  /**
   * Returns an associated array with all parameters.
   *
   * @return array All parameters
   */
  public function getParameters()
  {
    return $this->parameters;
  }
}
