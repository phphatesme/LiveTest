<?php

namespace phmLabs\Components\Annovent;

use phmLabs\Components\NamedParameters\NamedParameters;
use phmLabs\Components\Annovent\Event\Event;
use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass, ReflectionMethod;

class Dispatcher
{
  private $annotationReader;
  private $listeners = array();
  private $eventListenerMatrix = array();

  public function __construct()
  {
    $this->annotationReader = new AnnotationReader();
    $this->annotationReader->setDefaultAnnotationNamespace('phmLabs\Components\Annovent\Annotation\\');
    $this->annotationReader->setAutoloadAnnotations(true);
  }

  public function modify(Event $event, array $namedParameters = array())
  {
    return $this->processEvent($event, $namedParameters);
  }

  public function modifyUntil(Event $event, array $namedParameters = array())
  {
    return $this->processEvent($event, $namedParameters, true);
  }

  public function notify(Event $event, array $namedParameters = array())
  {
    return $this->processEvent($event, $namedParameters);
  }

  public function notifyUntil(Event $event, array $namedParameters = array())
  {
    return $this->processEvent($event, $namedParameters, true);
  }

  /**
   * This function is used to call all listeners. It stops processing if the $until parameter is true and the
   * return value of a listener is false.
   *
   * @param Event $event
   * @param array $namedParameters
   * @param boolean $until If this param is true the event/listener chain will stop if a listener returns false.
   */
  private function processEvent(Event &$event, array $namedParameters = array(), $until = false)
  {
    $result = true;
    if (array_key_exists($event->getName(), $this->eventListenerMatrix))
    {
      $event->isProcessed();
      $priorityOrderedListeners = $this->eventListenerMatrix[$event->getName()];
      ksort($priorityOrderedListeners);
      foreach ($priorityOrderedListeners as $listeners)
      {
        foreach ($listeners as $listenerInfo)
        {
          $listener = $listenerInfo['listener'];
          $method = $listenerInfo['method'];

          // @todo add try catch block
          $namedParameters = new NamedParameters();
          $callResult = $namedParameters->callMethod($listener, $method, $event->getParameters());

          $result = $result && !($callResult === false);

          if ($until && $callResult === false)
          {
            $event->interruptChain();
            return $result;
          }
        }
      }
    }
    return $result;
  }

  /**
   * This function is used to register a listener. Listeners are normal classes that are
   * decorated with annotations.
   *
   * @param Listener $listener
   * @throws Exception
   */
  public function register(Listener $listener, $priority = 500)
  {
    $annotationFound = false;
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
          $annotationFound = true;
          $listenerInfo = array('listener' => $listener,'method' => $reflectedMethod->getName());
          $this->eventListenerMatrix[$eventName][$priority][] = $listenerInfo;
        }
      }
    }

    if (!$annotationFound)
    {
      throw new Exception('The listener you added (' . get_class($listener) . ') does not listen to any event.');
    }
  }
}