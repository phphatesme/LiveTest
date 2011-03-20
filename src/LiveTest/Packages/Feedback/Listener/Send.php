<?php

/**
 * @todo add documentation & license boilerplate
 */
namespace LiveTest\Packages\Feedback\Listener;

use Zend\Http\Client\Adapter\Curl;

use Zend\Http\Client;

use Zend\Mail\Mail;

use LiveTest\Config\ConfigConfig;
use LiveTest\Listener\Base;

class Send extends Base
{
  const PHM_API = 'http://www.phmlabs.com/livetest/api/feedback.php';

  private $sendFeedback = false;

  private $feedbackAddress = 'error-livetest@phmlabs.com';

  private $kernelLibraries = array ('Base', 'LiveTest', 'Feedback' );

  private $exception;
  private $config;

  /**
   * @Event("LiveTest.Runner.InitConfig")
   *
   * @param Properties $properties
   */
  public function initConfig(ConfigConfig $config)
  {
    $this->config = $config;
  }

  /**
   * @Event("LiveTest.Runner.InitCore")
   *
   * @param array $arguments
   */
  public function runnerInitCore(array $arguments)
  {
    if (array_key_exists('feedback', $arguments))
    {
      $this->sendFeedback = true;
    }
    return true;
  }

  private function isUserSpace()
  {
    $library = substr(get_class($this->exception), 0, strpos(get_class($this->exception), '\\'));
    return !in_array($library, $this->kernelLibraries);
  }

  private function createAttachment()
  {
    $body = "Error Report (LiveTest Version " . LIVETEST_VERSION . ") \n\n";
    $body .= "  Message: " . $this->exception->getMessage() . "\n";
    $body .= "  File   : " . $this->exception->getFile() . "\n";
    $body .= "  Line   : " . $this->exception->getLine() . "\n\n";
    $trace = str_replace('#', '           #', $this->exception->getTraceAsString());
    $trace = str_replace('           #0', '#0', $trace);
    $body .= "  Trace  : " . $trace . "\n\n";
    if (!is_null($this->config))
    {
      $configString = $this->config->__toString();
      $body .= "  Configuration: " . $configString . "\n\n";
    }
    return $body;
  }

  /**
   * @todo use POST request instead of mailing (works for dev images)
   *
   * @Event("LiveTest.Runner.Error")
   *
   * @param \Exception $e
   */
  public function handleException(\Exception $exception)
  {
    $this->exception = $exception;

    if (!$this->isUserSpace($this->exception))
    {
      if ($this->sendFeedback)
      {
        try
        {
          $feedback = array ();
          $feedback = $this->createAttachment();

          $zend = new Client(self::PHM_API);
          $zend->setAdapter(new Curl());
          $zend->setParameterPost('feedback', $feedback);
          $zend->request('POST');

          echo "\n\n  All error related informations were sent. Thank you for helping to improve LiveTest.";
        }
        catch ( \Exception $e )
        {
          echo "\n\n  Unable to send feedback (".$e->getMessage().")";
        }
      }
      else
      {
        echo "\n\n  If this error occurs again please use the --feedback argument to send all \n" . "  error related information to our team.";
      }
    }
  }
}