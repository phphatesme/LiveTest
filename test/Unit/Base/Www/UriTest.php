<?php

namespace Test\Unit\baselibrary\Www;

use Base\Www\Uri;

class UriTest extends \PHPUnit_Framework_TestCase
{
  public function testGoodIsValid( )
  {
    $validUriStrings = array( 'http://example.com',
                              'https://example.com',
                              'http://www.example.com',
                              'www.example.com',
                              'www.example.com/index.php',
                              'http://www.example.com/index.php',
                              'http://www.example.com/index.php?foo=bar&blub=bla',
                              'http://www.example.com/index.php?foo:bar',
                              'ww.example.com',
                              'test.example.com',
                              'ftp://www.example.com',
                              'http://localhost/', // localhost is valid uri
                              'http://testservershostname/', // hostname in a local network
                              'http://localhost/~username/homedir/websites.php', // apache can be configured to read website from user homes
                              'http://172.123.4.56/', // ips should be vaild to
                              'https://user:pass@www.somewhere.com:8080/login.php?do=login&style=%23#pagetop',
							  'http://user@www.somewhere.com/#pagetop',
							  'https://somewhere.com/index.html',
							  'ftp://user:****@somewhere.com:21/',
                              'http://somewhere.com/index.html/'
                            );

    foreach ( $validUriStrings as $validUriString )
    {
      $this->assertTrue(Uri::isValid($validUriString), 'The uri "'.$validUriString . '" was not accepted as valid uri, but is.');
    }
  }

  public function testBadIsValid( )
  {
    $invalidUriStrings = array( '',
                                'www..examplepage',
                                '#',
                                ';',
                                'http://',
                                'http:/www.example.com',
                                'ftp:/www.example.com',
                                'tp://www.example.com',
                              );

    foreach ( $invalidUriStrings as $invalidUriString )
    {
      $this->assertFalse(Uri::isValid($invalidUriString), 'The uri "'.$invalidUriString . '" was accepted as valid uri, but isn\'t.' );
    }
  }

}
