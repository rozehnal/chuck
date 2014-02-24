<?php

interface IJiraIssuesRepository
{
    
    /**
     * 
     * @param string $key
     * @return JiraIssue
     */
    function findIssueByKey($key);
    
}