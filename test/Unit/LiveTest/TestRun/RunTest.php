<?php
namespace Unit\LiveTest\TestRun;

use Base\Http\ConnectionStatus;

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
include_once 'helper/ConnectionStatusListener.php';

/**
 * Test class for Run.
 */
class RunTest extends \PHPUnit_Framework_TestCase
{
  protected $run;

  private $infoListener;
  private $preRunListener;
  private $postRunListener;
  private $connectionStatusListener;

  private $properties;
  private $defaultUri;
  private $httpClient;

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

    $this->connectionStatusListener = new \ConnectionStatusListener('', $dispatcher);
    $dispatcher->registerListener($this->connectionStatusListener);

    $this->infoListener = new \InfoListener('', $dispatcher);
    $dispatcher->registerListener($this->infoListener);

    $this->properties = new Properties($yamlConfig, $this->defaultUri);
    $this->httpClient = new HttpClientMockup(new ResponseMockup());
    $this->run = new Run($this->properties, $this->httpClient, $dispatcher);
  }

  public function testNotifications()
  {
    $this->run->run();

    $this->assertTrue($this->preRunListener->isPreRunCalled());
    $this->assertTrue($this->postRunListener->isPostRunCalled());
    $this->assertTrue($this->connectionStatusListener->isHandleConnectionStatusCalled());
    $this->assertTrue($this->infoListener->isHandleResultCalled());
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

  public function testHandleSuccessConnectionStatus( )
  {
    $this->run->run();

    $status = $this->connectionStatusListener->getConnectionStatus();
    $this->assertEquals( $status->getType(), ConnectionStatus::SUCCESS );
    $this->assertEquals( $status->getUri()->toString(), 'http://www.example.com/index.html/' );
  }

  public function testHandleFailedConnectionStatus( )
  {
    $this->httpClient->nextRequestFails();

    $this->run->run();

    $status = $this->connectionStatusListener->getConnectionStatus();
    $this->assertEquals( $status->getType(), ConnectionStatus::ERROR );
    $this->assertEquals( $status->getUri()->toString(), 'http://www.example.com/index.html/' );
    $this->assertEquals( $status->getMessage(), 'TestException' );
  }

  public function testHandleResultNotification( )
  {
    // @todo implement
    // use test case that always failes
    // use another that never fails
  }
}