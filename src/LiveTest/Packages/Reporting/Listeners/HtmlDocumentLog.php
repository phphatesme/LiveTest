<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Reporting\Listeners;

use LiveTest\Listener\Base;

use Base\File\File;

use Base\Http\Response\Response;
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
    
    if (!file_exists($this->logPath))
    {
    	// @todo if uanble to create dir "Warning: mkdir(): Permission denied in /app1/ela/var/www/app/LiveTest/src/LiveTest/Packages/Reporting/Listeners/HtmlDocumentLog.php on line 54"    	
      mkdir($this->logPath, 0777, true);
    }
    
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
   * This function writes the html documents to a specified directory
   *
   * @Event("LiveTest.Run.HandleResult")
   */
  public function handleResult(Result $result, Response $response)
  {
    if (in_array($result->getStatus(), $this->logStatuses))
    {
      $filename = $this->logPath . urlencode($result->getUri()->toString());
      $file = new File($filename);
      $file->setContent($response->getBody());
      try
      {
        $file->save();
      }
      catch (\Exception $e)
      {
      	throw new ConfigurationException( 'Unable to write the html response to file "'.$filename.'"' );
      }
    }
  }
}