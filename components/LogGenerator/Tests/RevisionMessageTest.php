<?php

class RevisionMessageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function findJiraIssue_RevisionMessageWithoutTicketNumber_ReturnsNull()
    {
        $jiraWrapper = $this->getMockBuilder('JiraWrapper')->disableOriginalConstructor()->getMock();
        $jiraWrapper->expects($this->never())
                    ->method('getTicketInfo');
        $revisionMessage = new RevisionMessage(NULL, 'message');
        $jiraIssue = $revisionMessage->findJiraIssue($jiraWrapper);
        $this->assertNull($jiraIssue);
    }
    
    /**
     * @test
     */
    public function findJiraIssue_RevisionMessageWithTicketNumber_ReturnsJiraIssue()
    {
        $expectedJiraIssue = $this->getMock('IJiraIssue');
        $jiraWrapper = $this->getMockBuilder('JiraWrapper')->disableOriginalConstructor()->getMock();
        $jiraWrapper->expects($this->any())
                    ->method('getTicketInfo')
                    ->with('ticketNumber')
                    ->will($this->returnValue($expectedJiraIssue));
        $revisionMessage = new RevisionMessage('ticketNumber', 'message');
        $jiraIssue = $revisionMessage->findJiraIssue($jiraWrapper);
        $this->assertEquals($expectedJiraIssue, $jiraIssue);
    }
}