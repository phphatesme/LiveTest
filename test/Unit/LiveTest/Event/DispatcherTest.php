<?php

namespace Test\Unit\LiveTest\Event;

use LiveTest\Config\ConfigConfig;
use LiveTest\Event\Dispatcher;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{
  public function testRegisterByConfig()
  {
    $dispatcher = new Dispatcher();

    $config = new ConfigConfig();
    $config->addListener('myListener', 'Unit\LiveTest\Listener\MockUp', array('foo' => 'bar'));
    $dispatcher->registerByConfig($config, '');

    $listeners = $dispatcher->getListeners('Test');

    $listener = $listeners[0];

    $this->assertTrue($listener[0] instanceof \Unit\LiveTest\Listener\MockUp);
    $this->assertEquals('bar', $listener[0]->getFoo());
  }
}