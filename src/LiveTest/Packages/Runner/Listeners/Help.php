<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Runner\Listeners;

use phmLabs\Components\Annovent\Event\Event;

use LiveTest\Listener\Base;

/**
 * This extension is used to print the help content if the --help argument is set
 *
 * @author Nils Langner
 */
class Help extends Base
{
  /**
   * This template that contains the help text
   *
   * @var string The filename. Relative to __DIR__.
   */
  private $template = 'Help/template.tpl';

  private $templatePlaceholders = array('@@configPath@@',
  										'@@testSuitePath@@');

  private $examplesPath = 'examples';

  /**
   * This function echoes the global help if the --help command line argument is set
   *
   * @Event("LiveTest.Runner.Init")
   *
   * @param array $arguments
   */
  public function runnerInit(array $arguments, Event $event)
  {
    $path = $this->getBasePathFrom();

    if (array_key_exists('help', $arguments) || count($arguments) == 0)
    {
      $templateContent = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . $this->template);
      echo $this->replacePlaceholdersInTemplateContentWithPath($templateContent, $path);

      $event->setProcessed(); 
    }
    return true;
  }

  /**
   *
   * Replaces the template's placeholders with defined content.
   * @todo this replacement should be done in another class
   * @todo method name too long
   *
   * @param String $content
   * @param String $path
   *
   * @return String $content
   */
  private function replacePlaceholdersInTemplateContentWithPath($content, $path)
  {
    foreach($this->templatePlaceholders as $placeholder)
    {
        $content = str_replace($placeholder,
                               $this->getBasePath($path),
                               $content);
    }
    
    return $content;
  }

  private function getBasePath($path)
  {
    return ($path . DIRECTORY_SEPARATOR. $this->examplesPath. DIRECTORY_SEPARATOR);
  }

  private function getBasePathFrom()
  {
    return realpath(__DIR__.'/../../../../');
  }
}