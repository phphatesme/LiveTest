<?php

namespace Test\Unit\LiveTest\Listener\Cli;

use LiveTest\Event\Dispatcher;

use LiveTest\Listener\Cli\Help;

class HelpTest extends \PHPUnit_Framework_TestCase
{
  private function getTemplateContent( )
  {
    return file_get_contents(__DIR__.'/../../../../../src/LiveTest/Listener/Cli/Help/template.tpl');
  }

  public function testPreRunNone()
  {
    $help = new Help('', new Dispatcher());

    ob_start();
    $help->runnerInit( array( ) );
    $output = ob_get_contents();
    ob_clean();

    $this->assertEquals( $this->getTemplateContent(), $output );
  }

  public function testPreRunHelp()
  {
    $help = new Help('', new Dispatcher());

    ob_start();
    $help->runnerInit( array( 'help' => '' ) );
    $output = ob_get_contents();
    ob_clean();

    $this->assertEquals( $this->getTemplateContent(), $output );
  }

  public function testPreRunNoHelp()
  {
    $help = new Help('', new Dispatcher());

    ob_start();
    $help->runnerInit( array( 'testsuite' => '' ) );
    $output = ob_get_contents();
    ob_clean();

    $this->assertEquals( '', $output );
  }
}
