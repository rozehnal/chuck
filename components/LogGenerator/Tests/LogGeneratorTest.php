<?php

class SvnHelperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param  array       $returnValue
     * @return JiraWrapper
     */
    private function getJiraMock($returnValue = array())
    {
        $mock = $this->getMockBuilder('JiraWrapper')
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->any())
            ->method('getTicketInfo')
            ->will($this->returnValue($returnValue));

        return $mock;
    }

    /**
     * @param  int   $count
     * @return array
     */
    private function getTicketData($count = 3)
    {
        $ticketData = array(
            1 => array(
                'revision' => 1,
                'author' => "user01",
                'date' => "2014-02-07T07:32:03.065437Z",
                'msg' => "[XXX-73] message"
            ),
            2 => array(
                'revision' => 2,
                'author' => "user01",
                'date' => "2014-02-06T17:30:08.106324Z",
                'msg' => "Without ticket"
            ),
            3 => array(
                'revision' => 3,
                'author' => "user01",
                'date' => "2014-02-06T17:30:08.106324Z",
                'msg' => "Without ticket 2"
            )
        );

        return array_slice($ticketData, 0, $count);
    }

    public function testParseRevisionMessage_correctMessage()
    {
        $generator = new LogGenerator($this->getJiraMock());

        $result = $generator->parseRevisionMessage("[TEST-12] testing\n- lorem ipsum");
        $this->assertEquals('TEST-12', $result['ticket']);
    }

    public function testParseRevisionMessage_wrongMessage()
    {
        $generator = new LogGenerator($this->getJiraMock());

        $result = $generator->parseRevisionMessage("testing\n- lorem ipsum");
        $this->assertEquals('', $result['ticket']);

    }

    /**
     * @expectedException PHPUnit_Framework_Error_Notice
     */
    public function testGenerateTicketLog_correctData()
    {
        $generator = new LogGenerator($this->getJiraMock());
        $ticketLog = $generator->generateTicketLog($this->getTicketData(3));

        $this->assertArrayHasKey('ALL', $ticketLog);
        $this->assertArrayHasKey('OTHER', $ticketLog);
        $this->assertArrayHasKey('XXX-73', $ticketLog['OTHER']);
        $this->assertCount(2, $ticketLog);
        $this->assertCount(3, $ticketLog['ALL']);
        $this->assertCount(3, $ticketLog['OTHER']);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Notice
     */
    public function testGenerateTicketLog_issueType_RFC()
    {
        $ticketInfo =  array(
            'key'          => 'XXX-73',
            'typeName'     => 'RFC',
        );

        $generator = new LogGenerator($this->getJiraMock($ticketInfo));
        $ticketLog = $generator->generateTicketLog($this->getTicketData(1));	// temporary @ till sorting will be implemented

        $this->assertArrayHasKey('ALL', $ticketLog);
        $this->assertArrayHasKey('RFC', $ticketLog);
        $this->assertArrayHasKey('XXX-73', $ticketLog['RFC']);
        $this->assertCount(2, $ticketLog);
        $this->assertCount(1, $ticketLog['RFC']);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Notice
     */
    public function testGenerateTicketLog_issueType_Bug()
    {
        $ticketInfo =  array(
            'key'          => 'XXX-73',
            'typeName'     => 'Technical task',
        );

        $generator = new LogGenerator($this->getJiraMock($ticketInfo));
        $ticketLog = $generator->generateTicketLog($this->getTicketData(1));	// temporary @ till sorting will be implemented

        $this->assertArrayHasKey('ALL', $ticketLog);
        $this->assertArrayHasKey('RFC', $ticketLog);
        $this->assertArrayHasKey('XXX-73', $ticketLog['RFC']);
        $this->assertCount(2, $ticketLog);
        $this->assertCount(1, $ticketLog['RFC']);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Notice
     */
    public function testGenerateTicketLog_issueType_Support()
    {
        $ticketInfo =  array(
            'key'          => 'XXX-73',
            'typeName'     => 'Support Request',
        );

        $generator = new LogGenerator($this->getJiraMock($ticketInfo));
        $ticketLog = $generator->generateTicketLog($this->getTicketData(1));	// temporary @ till sorting will be implemented

        $this->assertArrayHasKey('ALL', $ticketLog);
        $this->assertArrayHasKey('SUPPORT', $ticketLog);
        $this->assertArrayHasKey('XXX-73', $ticketLog['SUPPORT']);
        $this->assertCount(2, $ticketLog);
        $this->assertCount(1, $ticketLog['SUPPORT']);
    }
}
