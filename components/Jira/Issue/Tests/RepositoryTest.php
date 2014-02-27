<?php

namespace DixonsCz\Chuck\Jira\Issue\Tests;

class IssuesRepositoryTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * @test
     */
    public function findByKey_ExistingIssuesKey_ReturnsThatIssue()
    {            
        $expectedIssue = $this->getMock('DixonsCz\Chuck\Jira\IIssue');
        
        $request = $this->getMock('DixonsCz\Chuck\Jira\IRequest');
        $requestFactory = $this->getMock('DixonsCz\Chuck\Jira\Request\IFactory');
        $requestFactory->expects($this->any())
                        ->method('createIssueRequestByKey')
                        ->with('existing_key')
                        ->will($this->returnValue($request));
        
        
        $client = $this->getMock('DixonsCz\Chuck\Jira\IClient');
        
        $responseTransformer = $this->getMock('DixonsCz\Chuck\Jira\Response\ISingleIssue');        
        $response = $this->getMock('DixonsCz\Chuck\Jira\IResponse');
        $response->expects($this->any())
                ->method('transform')
                ->with($responseTransformer)
                ->will($this->returnValue($expectedIssue));                        
        
        $request->expects($this->any())
                ->method('send')
                ->with($client)
                ->will($this->returnValue($response));
        
        $repository = new \DixonsCz\Chuck\Jira\Issue\Repository($requestFactory, $client, $responseTransformer);
        $issue = $repository->findIssueByKey('existing_key');
        $this->assertEquals($expectedIssue, $issue);
    }
    
}