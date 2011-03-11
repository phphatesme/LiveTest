<?php

namespace Annovent\Event;

use Annovent\Functions;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\AnnotationReader;

use ReflectionClass, ReflectionMethod;

class Dispatcher
{
  private $eventListenerMatrix = array();
  private $listeners = array();
  private $annotationReader;

  public function __construct()
  {
    $this->annotationReader = new AnnotationReader();
    $this->annotationReader->setDefaultAnnotationNamespace('Annovent\Annotation\\');
    $this->annotationReader->setAutoloadAnnotations(true);
  }

  public function notify($name, array $namedParameters = null)
  {
    $event = new Event($name, $namedParameters);
    return $this->notifyEvent($event);
  }

  public function notifyEvent(Event &$event)
  {
    $result = true;
    if (array_key_exists($event->getName(), $this->eventListenerMatrix))
    {
      $event->setProcessed();
      foreach ($this->eventListenerMatrix[$event->getName()] as $listenerInfo)
      {
        $listener = $listenerInfo['listener'];
        $method = $listenerInfo['method'];

        $callResult = Functions::call_user_func_assoc_array(array($listener,$method), $event->getParameters());
        $result = $result && !($callResult === false);
      }
    }
    return $result;
  }

  /**
   * @todo remove copy and paste (see notifyEvent)
   */
  public function notityUntil(Event &$event)
  {
    if (array_key_exists($event->getName(), $this->eventListenerMatrix))
    {
      $event->setProcessed();
      foreach ($this->eventListenerMatrix[$event->getName()] as $listenerInfo)
      {
        $listener = $listenerInfo['listener'];
        $method = $listenerInfo['method'];

        if (Functions::call_user_func_assoc_array(array($listener,$method), $event->getParameters()))
        {
          return false;
        }
      }
    }
    return true;
  }

  public function registerListener(Listener $listener)
  {
    $this->listeners[] = $listener;

    $reflectedListener = new ReflectionClass($listener);
    $publicMethods = $reflectedListener->getMethods(ReflectionMethod::IS_PUBLIC);

    foreach ($publicMethods as $reflectedMethod)
    {
      $annotations = $this->annotationReader->getMethodAnnotations($reflectedMethod);

      foreach ($annotations as $annotation)
      {
        $eventNames = $annotation->getNames();
        foreach ($eventNames as $eventName)
        {
          $listenerInfo = array('listener' => $listener,'method' => $reflectedMethod->getName());
          $this->eventListenerMatrix[$eventName][] = $listenerInfo;
        }
      }
    }
  }

  /**
   * Returns all registered listeners
   *
   * @return Listener[]
   */
  public function getListeners()
  {
    return $this->listeners;
  }
}