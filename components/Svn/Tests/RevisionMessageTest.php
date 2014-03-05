<?php

namespace DixonsCz\Chuck\Svn\Tests;

class RevisionMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function findJiraIssue_RevisionMessageWithoutTicketNumber_ReturnsNull()
    {
        $jiraWrapper = $this->getMockBuilder('DixonsCz\Chuck\Jira\Wrapper')->disableOriginalConstructor()->getMock();
        $jiraWrapper->expects($this->never())
                    ->method('getTicketInfo');
        $revisionMessage = new \DixonsCz\Chuck\Svn\RevisionMessage(NULL, 'message');
        $jiraIssue = $revisionMessage->findJiraIssue($jiraWrapper);
        $this->assertNull($jiraIssue);
    }
    
    /**
     * @test
     */
    public function findJiraIssue_RevisionMessageWithTicketNumber_ReturnsJiraIssue()
    {
        $expectedJiraIssue = $this->getMock('DixonsCz\Chuck\Jira\IIssue');
        $jiraWrapper = $this->getMockBuilder('DixonsCz\Chuck\Jira\Wrapper')->disableOriginalConstructor()->getMock();
        $jiraWrapper->expects($this->any())
                    ->method('getTicketInfo')
                    ->with('ticketNumber')
                    ->will($this->returnValue($expectedJiraIssue));
        $revisionMessage = new \DixonsCz\Chuck\Svn\RevisionMessage('ticketNumber', 'message');
        $jiraIssue = $revisionMessage->findJiraIssue($jiraWrapper);
        $this->assertEquals($expectedJiraIssue, $jiraIssue);
    }
    
    /**
     * @test
     */
    public function findJiraIssue_RevisionMessageWithInvalidTicketNumber_ReturnsNull()
    {        
        $jiraWrapper = $this->getMockBuilder('DixonsCz\Chuck\Jira\Wrapper')->disableOriginalConstructor()->getMock();
        $jiraWrapper->expects($this->any())
                    ->method('getTicketInfo')
                    ->with('ticketNumber')
                    ->will($this->returnValue(null));
        $revisionMessage = new \DixonsCz\Chuck\Svn\RevisionMessage('ticketNumber', 'message');
        $jiraIssue = $revisionMessage->findJiraIssue($jiraWrapper);
        $this->assertNull($jiraIssue);
    }
}