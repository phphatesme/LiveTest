<?php

namespace Unit\LiveTest\Packages\Runner\Listeners;

use phmLabs\Components\Annovent\Event\Event;

use LiveTest\Event\Dispatcher;

use LiveTest\Packages\Runner\Listeners\Help;

class HelpTest extends \PHPUnit_Framework_TestCase
{
  
  private $templatePlaceholders = array('@@configPath@@',
  										'@@testSuitePath@@');
  
  private $examplesPath = 'examples';
  
  private function getTemplateContent( )
  {
    $content = file_get_contents(__DIR__.'/../../../../../../src/LiveTest/Packages/Runner/Listeners/Help/template.tpl');
    $replacePath = '.' . DIRECTORY_SEPARATOR . $this->examplesPath. DIRECTORY_SEPARATOR;
    
    foreach($this->templatePlaceholders as $placeholder)
    {
        $content = str_replace($placeholder, 
                               $replacePath, 
                               $content);
    }
    
    return $content;
  }

  public function testPreRunNone()
  {
    $help = new Help('', new Dispatcher());

    ob_start();
    $help->runnerInit( array( ), new Event('*') );
    $output = ob_get_contents();
    ob_clean();
    
    $this->assertEquals( $this->getTemplateContent(), $output );
  }

  public function testPreRunHelp()
  {
    $help = new Help('', new Dispatcher());

    ob_start();
    $help->runnerInit( array( 'help' => '' ), new Event('*') );
    $output = ob_get_contents();
    ob_clean();

    $this->assertEquals( $this->getTemplateContent(), $output );
  }

  public function testPreRunNoHelp()
  {
    $help = new Help('', new Dispatcher());

    ob_start();
    $help->runnerInit( array( 'testsuite' => '' ), new Event('*') );
    $output = ob_get_contents();
    ob_clean();

    $this->assertEquals( '', $output );
  }
}
