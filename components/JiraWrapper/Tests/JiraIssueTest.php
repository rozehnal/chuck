<?php

class JiraIssueTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function isBug_BugIssue_ReturnsTrue()
    {
        $issue = new JiraIssue(null, null, null, null, null, null, null, null, null, null, null, null, $typeName = 'Bug', null);
        $this->assertTrue($issue->isBug());
    }
    
    /**
     * @test
     */
    public function isBug_NonBugIssue_ReturnsFalse()
    {
        $issue = new JiraIssue(null, null, null, null, null, null, null, null, null, null, null, null, $typeName = 'NonBug', null);
        $this->assertFalse($issue->isBug());
    }
    
    /**
     * @test
     */
    public function isRFC_RFCIssue_ReturnsTrue()
    {
        $issue = new JiraIssue(null, null, null, null, null, null, null, null, null, null, null, null, $typeName = 'RFC', null);
        $this->assertTrue($issue->isRFC());
    }
    
    /**
     * @test
     */
    public function isRFC_TechnicalTaskIssue_ReturnsTrue()
    {
        $issue = new JiraIssue(null, null, null, null, null, null, null, null, null, null, null, null, $typeName = 'Technical task', null);
        $this->assertTrue($issue->isRFC());
    }
    
    /**
     * @test
     */
    public function isRFC_NonRFCIssue_ReturnsFalse()
    {
        $issue = new JiraIssue(null, null, null, null, null, null, null, null, null, null, null, null, $typeName = 'NonRfc', null);
        $this->assertFalse($issue->isRFC());
    }
    
    /**
     * @test
     */
    public function isSupportRequest_SupportRequestIssue_ReturnsTrue()
    {
        $issue = new JiraIssue(null, null, null, null, null, null, null, null, null, null, null, null, $typeName = 'Support Request', null);
        $this->assertTrue($issue->isSupportRequest());
    }
    
    /**
     * @test
     */
    public function isSupportRequest_NonSupportRequestIssue_ReturnsFalse()
    {
        $issue = new JiraIssue(null, null, null, null, null, null, null, null, null, null, null, null, $typeName = 'Non Support Request', null);
        $this->assertFalse($issue->isSupportRequest());
    }
    
    /**
     * @test
     */
    public function isOther_OtherIssue_ReturnsTrue()
    {
        $issue = new JiraIssue(null, null, null, null, null, null, null, null, null, null, null, null, $typeName = 'Some other type', null);
        $this->assertTrue($issue->isOther());
    }
    
    /**
     * @test
     */
    public function isOther_RFCIssue_ReturnsTrue()
    {
        $issue = new JiraIssue(null, null, null, null, null, null, null, null, null, null, null, null, $typeName = 'RFC', null);
        $this->assertFalse($issue->isOther());
    }
    
    /**
     * @test
     */
    public function isOther_BugIssue_ReturnsTrue()
    {
        $issue = new JiraIssue(null, null, null, null, null, null, null, null, null, null, null, null, $typeName = 'Bug', null);
        $this->assertFalse($issue->isOther());
    }
    
    /**
     * @test
     */
    public function isOther_SupportRequestIssue_ReturnsTrue()
    {
        $issue = new JiraIssue(null, null, null, null, null, null, null, null, null, null, null, null, $typeName = 'Support Request', null);
        $this->assertFalse($issue->isOther());
    }
    
}