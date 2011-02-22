<?php
namespace Unit\LiveTest\TestRun;

use Annovent\Event\Dispatcher;

use Unit\LiveTest\TestRun\Mockups\TestExtension;
use Unit\LiveTest\TestRun\Mockups\TestHandleConnectionStatusExtension;
use Unit\LiveTest\TestRun\Mockups\ResponseMockup;
use Unit\LiveTest\TestRun\Mockups\HttpClientMockup;
use LiveTest\TestRun\Run;
use LiveTest\TestRun\Properties;
use Base\Config\Yaml;

use Base\Www\Uri;

include_once 'helper/InfoListener.php';
include_once 'helper/PreRunListener.php';
include_once 'helper/PostRunListener.php';

/**
 * Test class for Run.
 */
class RunTest extends \PHPUnit_Framework_TestCase
{
  protected $run;

  private $infoListener;
  private $preRunListener;
  private $postRunListener;

  private $properties;
  private $defaultUri;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $yamlConfig = new Yaml(__DIR__ . '/Fixtures/testsuite.yml', true);
    $this->defaultUri = new Uri('http://www.example.com/index.html');

    $dispatcher = new Dispatcher();

    $this->preRunListener = new \PreRunListener('', $dispatcher);
    $dispatcher->registerListener($this->preRunListener);

    $this->postRunListener = new \postRunListener('', $dispatcher);
    $dispatcher->registerListener($this->postRunListener);

    $this->infoListener = new \InfoListener('', $dispatcher);
    $dispatcher->registerListener($this->infoListener);

    $this->properties = new Properties($yamlConfig, $this->defaultUri);
    $this->run = new Run($this->properties, new HttpClientMockup(new ResponseMockup()), $dispatcher);
  }

  public function testNotifications()
  {
    $this->run->run();

    $this->assertTrue($this->preRunListener->isPreRunCalled());
    $this->assertTrue($this->postRunListener->isPostRunCalled());
    $this->assertTrue($this->infoListener->isHandleResultCalled());
    $this->assertTrue($this->infoListener->isHandleConnectionStatusCalled());
  }

  public function testPreRunNotification( )
  {
    $this->run->run();
    $this->assertEquals($this->properties, $this->preRunListener->getProperties());
  }

  public function testPostRunNotification( )
  {
    $this->run->run();

    $information = $this->postRunListener->getInformation();

    $this->assertEquals(0, $information->getDuration());
    $this->assertEquals($this->defaultUri, $information->getDefaultDomain());
  }
}