<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Reporting\Listeners;

use Base\File\File;
use Base\Http\Response\Response;

use LiveTest\Listener\Base;
use LiveTest\TestRun\Result\Result;
use LiveTest\ConfigurationException;

/**
 * This listener writes all specified html documents in to a defined directory. The
 * listener creates a directory with the value of the runId within the log path.
 *
 * @author Nils Langner
 */
class HtmlDocumentLog extends Base
{
  /**
   * The diretory were to log
   * @var string
   */
  private $logPath;

  /**
   * The result statuses to log
   * @var array
   */
  private $logStatuses = array ();

  /**
   * This function initializes the log path and if given the log statuses
   *
   * @todo use Base\File\? for this
   *
   * @param string $logPath
   * @param array $logStatuses
   */
  public function init($logPath, array $logStatuses = null)
  {
    $this->logPath = $logPath . '/' . $this->getRunId() . '/';

    if (!is_null($logStatuses))
    {
      $this->logStatuses = $logStatuses;
    }
    else
    {
      $this->logStatuses = array (Result::STATUS_ERROR, Result::STATUS_FAILED);
    }
  }

  /**
   * Checks if a directory exists. If not it is created.
   * @todo this should be done in the base library
   * @param String $logDir Path to directory which should be created if not exists
   */
  private function createLogDirIfNotExists($logDir)
  {
    if (!is_dir($logDir))
    {
      $this->createLogDirRecursively($logDir);
    }
  }

  /**
   * Trys to create the given $logDir recursively. If an error occurs, an exception
   * is thrown.
   * @todo this should be done in the base library
   * @param String $logDir Path to directory which should be created
   * @throws ConfigurationException
   */
  private function createLogDirRecursively($logDir)
  {
     if(false === @mkdir($logDir, 0777, true))
     {
       $lastError = error_get_last();
       throw new ConfigurationException('Could not create Log-Directory: '.$logDir.'; Error: '.$lastError['message']);
     }
  }

  /**
   * This function writes the html documents to a specified directory
   *
   * @Event("LiveTest.Run.HandleResult")
   */
  public function handleResult(Result $result, Response $response)
  {
    if (in_array($result->getStatus(), $this->logStatuses))
    {
      $filename = $this->logPath . urlencode($result->getRequest()->getIdentifier().'.html');
      $file = new File($filename);
      $file->setContent($response->getBody());
      try
      {
      	$this->createLogDirIfNotExists($this->logPath);
        $file->save();
      }
      catch (\Exception $e)
      {
        throw new ConfigurationException( 'Unable to write the html response to file "'.$filename.'"' );
      }
    }
  }
}