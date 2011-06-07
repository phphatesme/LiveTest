<?php

namespace LiveTest\TestCase\General\Html;

use LiveTest\ConfigurationException;
use LiveTest\InvalidArgumentException;
use LiveTest\TestCase\General\Html\Dom\XPath\Exists;
use LiveTest\TestCase\Exception;
use LiveTest\TestCase\General\Html\Dom\XPath\Exception as XPathException;

use \DOMXPath;

class IdPresent extends Exists
{
  public function init($id = null, $ids = null)
  {
    $xpath = $this->idToXPath($id);
    $xpaths = $this->idsToXPaths($ids);
    
    try
    {
      return parent::init($xpath, $xpaths);
    }
    catch (InvalidArgumentException $e)
    {
      if ($e->getArgument() === 'xpath')
      {
        $message = 'The id parameter must be an integer';
        $argument = 'id';
      }
      elseif ($e->getArgument() === 'xpath')
      {
        $message = 'The ids parameter mus ne an array';
        $argument = 'ids';
      }
      throw new InvalidArgumentException($message, $argument);
    }
    catch (ConfigurationException $e)
    {
      throw new ConfigurationException('Neither id nor ids parameter is set.');
    }
  }
  
  private function idsToXPaths($ids)
  {
    if (!is_null($ids))
    {
      foreach ($ids as $identifier)
      {
        $xpaths[] = $this->idToXPath($identifier);
      }
    }
    else
    {
      $xpaths = null;
    }
    return $xpaths;
  }
  
  private function idToXPath($id)
  {
    if (!is_null($id))
    {
      return sprintf('//*[@id="%s"]', $id);
    }
    else
    {
      return null;
    }
  }
  
  protected function doXPathTest(DOMXPath $domXPath)
  {
    try
    {
      parent::doXPathTest($domXPath);
    }
    catch (XPathException $e)
    {
      preg_match('#//\*\[@id="(.*)"\]#', $e->getXPath(), $matches);
      throw new Exception('The given html id ("' . $matches[1] . '") was not found.', null, $e);
    }
  }
}