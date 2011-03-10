<?php

/**
 * @todo add documentation & license boilerplate
 */
namespace LiveTest\Packages\Feedback\Listener;

use LiveTest\Config\ConfigConfig;
use LiveTest\Listener\Base;

class Send extends Base
{
  private $sendFeedback = false;

  private $feedbackAddress = 'error-livetest@phmlabs.com';

  private $kernelLibraries = array('Base','LiveTest','Feedback');

  private $exception;
  private $config;

  /**
   * @event LiveTest.Runner.InitConfig
   *
   * @param Properties $properties
   */
  public function initConfig(ConfigConfig $config)
  {
    $this->config = $config;
  }

  /**
   * @event LiveTest.Runner.InitCore
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
    $body = "Error Report (LiveTest Version ".LIVETEST_VERSION.") \n\n";
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
   * @event LiveTest.Runner.Error
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
        $body = $this->createAttachment();
        $mail = new \Zend_Mail();

        $mail->addTo($this->feedbackAddress);
        $mail->setSubject('LiveTest: Error Report');

        $mail->setBodyText($body);
        $mail->send();
        echo "\n\n  An e-mail with all error related information was sent. Thank you for helping to improve LiveTest.";
      }
      else
      {
        echo "\n\n  If this error occurs again please use the --feedback argument to send an automated \n" . "  e-mail with all error related information to our team.";
      }
    }
  }
}