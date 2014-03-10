<?php

namespace DixonsCz\Chuck\Jira\Issue;

interface IRepository
{
    
    /**
     * 
     * @param string $key
     * @return \DixonsCz\Chuck\Jira\IIssue
     */
    function findIssueByKey($key);
    
}