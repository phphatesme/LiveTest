<?php

namespace Unit\LiveTest\Config\Tags;

use LiveTest\Config\Tags\Config\Listener;

use LiveTest\Config\Parser\Parser;

use LiveTest\Config\ConfigConfig;

class ListenerTest extends \PHPUnit_Framework_TestCase
{
   
  public function testSetListener()
  {
  	$config = new ConfigConfig();
    $listener = new Listener(array('test' => array('class' => 'testSetListener')), $config, new Parser('/'));
	$listener->process();
	
	$listeners = $config->getListeners();
	$this->assertEquals($listeners['test']['className'], 'testSetListener');
  }
  
  /**
     * @expectedException \Exception
  */
  public function testSetListenerException()
  {
     $listener = new Listener(array('test' =>array('class' => '')), $config, new Parser('/'));
	 $listener->process();
  }
}