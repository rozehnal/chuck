<?php

namespace DixonsCz\Chuck\Svn\RevisionMessage\Tests;

class RevisionMessageParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function parseFromString_MessageWithTicketNumber_ReturnsRevisionMessage()
    {
        $expectedMessage = new \DixonsCz\Chuck\Svn\RevisionMessage('DEV-1', 'message');
        $parser = new \DixonsCz\Chuck\Svn\RevisionMessage\Parser();
        $result = $parser->parseFromString('[DEV-1] message');
        $this->assertEquals($expectedMessage, $result);
    }
    
    /**
     * @test
     */
    public function parseFromString_MessageWithoutTicketNumber_ReturnsRevisionMessage()
    {
        $expectedMessage = new \DixonsCz\Chuck\Svn\RevisionMessage(null, '[noValidTicketNumber] message');
        $parser = new \DixonsCz\Chuck\Svn\RevisionMessage\Parser();
        $result = $parser->parseFromString('[noValidTicketNumber] message');
        $this->assertEquals($expectedMessage, $result);
    }
    
}
