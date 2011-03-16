<?php

namespace phmLabs\Components\Annovent;

use phmLabs\Components\NamedParameters\Functions;
use Doctrine\Common\Annotations\AnnotationReader;

use phmLabs\Components\Annovent\Event\EventInterface;

use ReflectionClass, ReflectionMethod;

class Dispatcher implements DispatcherInterface
{
  private $annotationReader;
  private $listeners = array();

  public function __construct()
  {
    $this->annotationReader = new AnnotationReader();
    $this->annotationReader->setDefaultAnnotationNamespace('phmLabs\Components\Annovent\Annotation\\');
    $this->annotationReader->setAutoloadAnnotations(true);
  }

  /**
   * Notifies all listeners of a given event.
   *
   * @param EventInterface $event An EventInterface instance
   */
  public function notify(EventInterface $event)
  {
    $this->processEvent($event);
  }

  /**
   * Notifies all listeners of a given event until one processes the event.
   *
   * @param  EventInterface $event An EventInterface instance
   *
   * @return mixed The returned value of the listener that processed the event
   */
  public function notifyUntil(EventInterface $event)
  {
    return $this->processEvent($event, true);
  }

  /**
   * Returns all wildcard names of events the listerner should notify
   *
   * @param string $eventName
   */
  private function getWildcardEventNames($eventName)
  {
    $nodes = explode('.', $eventName);
    $wildcardNames = array('*');
    $path = '';

    for($i = 0; $i < count($nodes) - 1; $i++)
    {
      if ($i == 0)
      {
        $path = $path . $nodes[$i];
        $wildcardNames[] = $path . '.*';
      }
      else
      {
        $path = $path . '.' . $nodes[$i];
        $wildcardNames[] = $path . '.*';
      }
    }
    return $wildcardNames;
  }

  /**
   * This function is used to call all listeners. It stops processing if the $until parameter is true and the
   * event is processed.
   *
   * @param Event $event
   * @param array $namedParameters
   * @param boolean $until If this param is true the event/listener chain will stop if the vent is processed.
   */
  private function processEvent(EventInterface &$event, $until = false)
  {
    $finalParameters = $event->getParameters();
    $finalParameters['event'] = $event;

    $result = '';

    foreach ($this->getListeners($event->getName()) as $listener)
    {
      $result = Functions::call_user_func_assoc_array($listener, $finalParameters);
      if ($until === true && $event->isProcessed())
      {
        return $result;
      }
    }
    return $result;
  }

  /**
   * Connects a listener to a given event name.
   *
   * Listeners with a higher priority are executed first.
   *
   * @param string  $name      An event name
   * @param mixed   $listener  A PHP callable
   * @param integer $priority  The priority (between -10 and 10 -- defaults to 0)
   */
  public function connect($name, $callback, $priority = 0)
  {
    $this->listeners[$name][$priority][] = $callback;
  }

  /**
   * Disconnects one, or all listeners for the given event name.
   *
   * @param string     $name     An event name
   * @param mixed|null $listener The listener to remove, or null to remove all
   *
   * @return void
   */
  public function disconnect($name, $callback = null)
  {
    if (!isset($this->listeners[$name]))
    {
      return;
    }

    if (null === $callback)
    {
      unset($this->listeners[$name]);
      return;
    }

    foreach ($this->listeners[$name] as $priority => $callables)
    {
      foreach ($callables as $i => $callable)
      {
        if ($callback === $callable)
        {
          unset($this->listeners[$name][$priority][$i]);
        }
      }
    }
  }

  /**
   * This function is used to register a listener. Listeners are normal classes that are
   * decorated with annotations.
   *
   * @param Listener $listener
   * @throws Exception
   */
  public function connectListener($listener, $priority = 0)
  {
    $annotationFound = false;

    $reflectedListener = new ReflectionClass($listener);
    $publicMethods = $reflectedListener->getMethods(ReflectionMethod::IS_PUBLIC);

    foreach ($publicMethods as $reflectedMethod)
    {
      $annotations = $this->annotationReader->getMethodAnnotations($reflectedMethod);

      foreach ($annotations as $annotation)
      {
        $annotationFound = true;
        $eventNames = $annotation->getNames();
        foreach ($eventNames as $eventName)
        {
          $callback = array($listener,$reflectedMethod->getName());
          $this->connect($eventName, $callback, $priority);
        }
      }
    }

    if (!$annotationFound)
    {
      throw new Exception('The listener you added (' . get_class($listener) . ') does not listen to any event.');
    }
  }

  /**
   * Returns true if the given event name has some listeners.
   *
   * @param  string $name The event name
   *
   * @return Boolean true if some listeners are connected, false otherwise
   */
  public function hasListeners($name)
  {
    return array_key_exists($name, $this->listeners);
  }

  /**
   * Returns all listeners associated with a given event name.
   *
   * @param  string $name The event name
   *
   * @return array  An array of listeners
   */
  public function getListeners($name)
  {
    $eventNames = $this->getWildcardEventNames($name);
    $eventNames[] = $name;

    $listeners = array();

    foreach ($eventNames as $eventName)
    {
      if (array_key_exists($eventName, $this->listeners))
      {
        $listeners = array_merge_recursive($listeners, $this->listeners[$eventName]);
      }
    }

    krsort($listeners);

    if (count($listeners) == 0)
    {
      return array();
    }

    return call_user_func_array('array_merge', $listeners);
  }
}