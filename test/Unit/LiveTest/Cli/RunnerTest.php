<?php
namespace Unit\LiveTest\Cli;

use LiveTest\Config\ConfigConfig;

use Unit\LiveTest\Cli\Mockups\CliListener;

use LiveTest\Event\Dispatcher;

use \LiveTest\Cli\Runner;

/**
 * 
 * @todo implement test for run-method
 * @author mikelohmann
 *
 */

class RunnerTest extends \PHPUnit_Framework_TestCase
{
  
  private $runner;
  private $dispatcher;
  
  public function setUp()
  {
     include_once __DIR__ . '/../../../../src/version.php';
     $this->dispatcher = new Dispatcher();
     $this->dispatcher->connectListener(new CliListener(1, $this->dispatcher),1);
     $this->runner = new Runner( array('foo'=>'bar'), $this->dispatcher );
  }
  
  public function testRunnersListeners()
  {
    $listener = $this->getListenerForEvent( 'LiveTest.Runner.Init' );
    $this->assertEquals('bar', $listener->getArgument('foo'));
   
    $listener = $this->getListenerForEvent( 'LiveTest.Runner.InitConfig' );
    $this->assertEquals('http://www.example.com', $listener->getConfigDefaultDomain());
    
    $listener = $this->getListenerForEvent( 'LiveTest.Runner.InitCore' );
    $this->assertEquals('bar', $listener->getCoreArgument('foo'));
    
    #$this->assertTrue($listener[0] instanceof \Unit\LiveTest\Listener\MockUp);
  }
  
  public function testRunnerRun()
  {
    $runner = new Runner( array('testsuite'=>__DIR__.'/../../../../src/examples/testsuite.yml'), $this->dispatcher );
    $runner->run();
    
    $runner = new Runner( array('testsuite'=>'../../../../src/examples/testsuite.yml'), $this->dispatcher );
    $this->setExpectedException('LiveTest\ConfigurationException');
    $runner->run();
    
    $this->setExpectedException('LiveTest\ConfigurationException');
    $this->runner->run();
  }
  
  private function getListenerForEvent( $eventName )
  {
    $listeners = $this->dispatcher->getListeners($eventName);
    $listener = null;
    
    foreach( $listeners as $aListener)
    {
      
      if(true === ($aListener[0] instanceof \Unit\LiveTest\Cli\Mockups\CliListener))
      {
         $listener = $aListener[0];
         break;
      }
    
    }
    
    return $listener;
  }
}