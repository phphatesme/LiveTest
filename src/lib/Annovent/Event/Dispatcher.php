<?php

namespace Annovent\Event;

class Dispatcher
{
  private $eventListenerMatrix = array();
    
  public function notify( $name, array $namedParameters = null )
  {
    $event = new Event($name, $namedParameters);
    return $this->notifyEvent($event);
  }
  
  public function notifyEvent(Event $event)
  {
    $result = true;
    if (array_key_exists($event->getName(), $this->eventListenerMatrix))
    {
      foreach ($this->eventListenerMatrix[$event->getName()] as $listenerInfo)
      {
        $listener = $listenerInfo['listener'];
        $method = $listenerInfo['method'];
        
        $callResult = \Annovent\call_user_func_assoc_array(array($listener,$method), $event->getParameters());
        $result = $result && !($callResult == false);
      }
    }
    return $result;
  }
  
  public function notityUntil(Event $event)
  {
    if (array_key_exists($event->getName(), $this->eventListenerMatrix))
    {
      foreach ($this->eventListenerMatrix[$event->getName()] as $listenerInfo)
      {
        $listener = $listenerInfo['listener'];
        $method = $listenerInfo['method'];
        
        if (\Annovent\call_user_func_assoc_array(array($listener,$method), $event->getParameters()))
        {
          return false;
        }
      }
    }
    return true;
  }
  
  public function registerListener(Listener $listener)
  {
    $reflectedListener = new \ReflectionClass($listener);
    
    foreach ($reflectedListener->getMethods() as $reflectedMethod)
    {
      if ($reflectedMethod->isPublic())
      {
        $docComment = $reflectedMethod->getDocComment();
        $annotationFound = (bool)preg_match('^@event(.*)^', $docComment, $matches);
        
        if ($annotationFound)
        {
          $eventName = str_replace(chr(13), '', $matches[1]);
          $eventName = str_replace(' ', '', $eventName);
          
          $listenerInfo = array('listener' => $listener,'method' => $reflectedMethod->getName());
          
          $this->eventListenerMatrix[$eventName][] = $listenerInfo;
        }
      }
    }
  }
}