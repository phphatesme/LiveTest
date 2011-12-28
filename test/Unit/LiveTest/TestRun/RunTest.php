<?php
namespace Unit\LiveTest\TestRun;

use Base\Http\ConnectionStatus;

use LiveTest\Event\Dispatcher;
use LiveTest\TestRun\Result;
use LiveTest\Config\TestSuite;
use LiveTest\TestRun\Run;
use LiveTest\TestRun\Properties;

use Base\Config\Yaml;
use Base\Www\Uri;

use Unit\LiveTest\TestRun\Helper\ConnectionStatusListener;
use Unit\LiveTest\TestRun\Helper\HandleResultListener;
use Unit\LiveTest\TestRun\Helper\InfoListener;
use Unit\LiveTest\TestRun\Helper\PostRunListener;
use Unit\LiveTest\TestRun\Helper\PreRunListener;
use Unit\LiveTest\TestRun\Mockups\TestExtension;
use Unit\LiveTest\TestRun\Mockups\TestHandleConnectionStatusExtension;
use Unit\LiveTest\TestRun\Mockups\ResponseMockup;
use Unit\LiveTest\TestRun\Mockups\HttpClientMockup;

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

  private $dispatcher;
  private $properties;
  private $defaultUri;
  private $httpClients;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->defaultUri = new Uri('http://www.example.com/index.html');

    $this->dispatcher = new Dispatcher();

    $this->preRunListener = new PreRunListener('', $this->dispatcher);
    $this->dispatcher->connectListener($this->preRunListener);

    $this->postRunListener = new PostRunListener('', $this->dispatcher);
    $this->dispatcher->connectListener($this->postRunListener);

    $this->connectionStatusListener = new ConnectionStatusListener('', $this->dispatcher);
    $this->dispatcher->connectListener($this->connectionStatusListener);

    $this->infoListener = new InfoListener('', $this->dispatcher);
    $this->dispatcher->connectListener($this->infoListener);

    $this->handleResultListener = new HandleResultListener('', $this->dispatcher);
    $this->dispatcher->connectListener($this->handleResultListener);

    $this->properties = Properties::createByYamlFile(__DIR__ . '/Fixtures/testsuite.yml', $this->defaultUri, new Dispatcher());
    $this->httpClients['default'] = new HttpClientMockup(new ResponseMockup());
    $this->run = new Run($this->properties, $this->httpClients, $this->dispatcher);
  }

  public function testNotifications()
  {
    $this->run->run();

    $this->assertTrue($this->preRunListener->isPreRunCalled());
    $this->assertTrue($this->postRunListener->isPostRunCalled());
    $this->assertTrue($this->connectionStatusListener->isHandleConnectionStatusCalled());
    $this->assertTrue($this->handleResultListener->isHandleResultCalled());
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

    $this->assertLessThan(1000, $information->getDuration());
    $this->assertEquals($this->defaultUri, $information->getDefaultDomain());
  }

  public function testHandleSuccessConnectionStatus( )
  {
    $this->run->run();

    $status = $this->connectionStatusListener->getConnectionStatus();
    $this->assertEquals( $status->getType(), ConnectionStatus::SUCCESS );
    $this->assertEquals( $status->getRequest()->getUri(), 'http://www.example.com/index.html' );
  }

  public function testHandleFailedConnectionStatus( )
  {
    $this->httpClients['default']->nextRequestFails();

    $this->run->run();

    $status = $this->connectionStatusListener->getConnectionStatus();
    $this->assertEquals( $status->getType(), ConnectionStatus::ERROR );
    $this->assertEquals( $status->getRequest()->getUri(), 'http://www.example.com/index.html' );
    $this->assertEquals( $status->getMessage(), 'TestException' );
  }

  public function testHandleResultNotification( )
  {
    $this->run->run();
    $results = $this->handleResultListener->getResults();
    $responses = $this->handleResultListener->getResponses();

    $tmpResponse = 0;
    $tmpStatus = 0;

    foreach( $results as $key => $aResult)
    {
      if($aResult->getStatus() == $aResult::STATUS_SUCCESS)
      {
        $tmpStatus = $aResult->getStatus();
        $tmpResponse = $responses[$key];
        break;
      }
    }

    $this->assertEquals( $tmpStatus, $aResult::STATUS_SUCCESS );
    $this->assertEquals( $tmpResponse->getBody(), 'body');

    $httpClient = new HttpClientMockup(new ResponseMockup(404,'Not Found'));
    $run = new Run($this->properties, array( 'default' => $httpClient), $this->dispatcher);
    $run->run();

    $results = $this->handleResultListener->getResults();
    $responses = $this->handleResultListener->getResponses();
    foreach( $results as $key => $aResult)
    {
      if($aResult->getStatus() == $aResult::STATUS_FAILED)
      {
        $tmpStatus = $aResult->getStatus();
        $tmpResponse = $responses[$key];
        break;
      }
    }

    $this->assertEquals( $aResult::STATUS_FAILED, $tmpStatus );
    $this->assertEquals( $tmpResponse->getBody(), 'Not Found');

  }
}