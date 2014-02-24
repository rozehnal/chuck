<?php

class JiraIssuesRepository implements IJiraIssuesRepository
{
    
    /**
     *
     * @var IJiraRequestsFactory
     */
    protected $requestsFactory;
    
    /**
     *
     * @var IJiraClient
     */
    protected $client;
    
    /**
     *
     * @var IJiraResponseTransformer
     */
    protected $singleIssueTransformer;
    
    /**
     * 
     * @param IJiraRequestsFactory $requestFactory
     * @param IJiraClient $client
     * @param ISingleIssueTransformer $singleIssueTransformer
     */
    public function __construct(IJiraRequestsFactory $requestFactory, IJiraClient $client, ISingleIssueTransformer $singleIssueTransformer)
    {
        $this->requestsFactory = $requestFactory;
        $this->client = $client;
        $this->singleIssueTransformer = $singleIssueTransformer;
    }
    
    /**
     * 
     * @param string $key
     * @return JiraIssue
     */
    public function findIssueByKey($key)
    {
        $request = $this->requestsFactory->createIssueRequestByKey($key);
        $response = $request->send($this->client);
        $issue = $response->transform($this->singleIssueTransformer);
        return $issue;
    }

}