<?php

namespace DixonsCz\Chuck\Jira\Issue;

interface IRepository
{
    
    /**
     * 
     * @param string $key
     * @return Issue
     */
    function findIssueByKey($key);
    
}