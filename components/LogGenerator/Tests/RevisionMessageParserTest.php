<?php

class RevisionMessageParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function parseFromString_MessageWithTicketNumber_ReturnsRevisionMessage()
    {
        $expectedMessage = new RevisionMessage('DEV-1', 'message');
        $parser = new RevisionMessageParser();
        $result = $parser->parseFromString('[DEV-1] message');
        $this->assertEquals($expectedMessage, $result);
    }
    
    /**
     * @test
     */
    public function parseFromString_MessageWithoutTicketNumber_ReturnsRevisionMessage()
    {
        $expectedMessage = new RevisionMessage(null, '[noValidTicketNumber] message');
        $parser = new RevisionMessageParser();
        $result = $parser->parseFromString('[noValidTicketNumber] message');
        $this->assertEquals($expectedMessage, $result);
    }
    
}
