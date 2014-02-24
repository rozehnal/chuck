<?php

class JiraIssuesRepositoryTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * @test
     */
    public function findByKey_ExistingIssuesKey_ReturnsThatIssue()
    {
        $reportedDate = new DateTime('2000-01-01');
        $createdDate = new DateTime('2000-01-02');        
        $updatedDate = new DateTime('2000-01-03');        
        $expectedIssue = new JiraIssue('existing_key', 
                                        'summary', 
                                        'asigneeName', 
                                        'asigneeDisplayName', 
                                        $reportedDate, 
                                        $createdDate, 
                                        $updatedDate, 
                                        'description', 
                                        'priority', 
                                        'priorityIcon', 
                                        'status', 
                                        'statusIcon', 
                                        'typeName', 
                                        'typeIcon');
        
        $request = $this->getMock('IJiraRequest');
        $requestFactory = $this->getMock('IJiraRequestsFactory');
        $requestFactory->expects($this->any())
                        ->method('createIssueRequestByKey')
                        ->with('existing_key')
                        ->will($this->returnValue($request));
        
        
        $client = $this->getMock('IJiraClient');
        
        $responseTransformer = $this->getMock('ISingleIssueTransformer');        
        $response = $this->getMock('IJiraResponse');
        $response->expects($this->any())
                ->method('transform')
                ->with($responseTransformer)
                ->will($this->returnValue($expectedIssue));                        
        
        $request->expects($this->any())
                ->method('send')
                ->with($client)
                ->will($this->returnValue($response));
        
        $repository = new JiraIssuesRepository($requestFactory, $client, $responseTransformer);
        $issue = $repository->findIssueByKey('existing_key');
        $this->assertEquals($expectedIssue, $issue);
    }
    
}