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

/**
 * Test class for Run.
 */
class RunTest extends \PHPUnit_Framework_TestCase
{
  protected $run;

  private $infoListener;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $yamlConfig = new Yaml(__DIR__ . '/Fixtures/testsuite.yml', true);
    $defaultUri = new Uri('http://www.example.com/index.html');

    $dispatcher = new Dispatcher();
    $this->infoListener = new \InfoListener('', $dispatcher);
    $dispatcher->registerListener($this->infoListener);

    $properties = new Properties($yamlConfig, $defaultUri);
    $this->run = new Run($properties, new HttpClientMockup(new ResponseMockup()), $dispatcher);
  }

  public function testNotifications()
  {
    $this->run->run();

    $this->assertTrue($this->infoListener->isPreRunCalled());
    $this->assertTrue($this->infoListener->isPostRunCalled());
    $this->assertTrue($this->infoListener->isHandleResultCalled());
    $this->assertTrue($this->infoListener->isHandleConnectionStatusCalled());
  }
}