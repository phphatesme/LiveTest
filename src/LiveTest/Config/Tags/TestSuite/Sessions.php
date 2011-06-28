<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

/**
 * This tag adds the test cases to the configuration. All tags that are not known withing this class are
 * handed to parser.
 *
 * @example
 * Sessions:
     user_handling:
       Pages:
         - /login.php:
           post:
             key1: value1
             key2: value2
         - /index.php
         
 *
 * @author Mike Lohmann
 */
class Sessions extends Base
{
  /**
   * @see LiveTest\Config\Tags\TestSuite.Base::doProcess()
   */
  protected function doProcess(\LiveTest\Config\TestSuite $config, $sessions)
  {
    foreach ($sessions as $sessionName => $session)
    {
      $parser = $this->getParser();
      $config->getNewSession($sessionName, true);
      $parser->parse($session, $config);
      $config->switchToDefaultSession();
    }    
  }
}