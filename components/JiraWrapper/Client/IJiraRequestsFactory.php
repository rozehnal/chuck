<?php

interface IJiraRequestsFactory
{
    
    /**
     * @param string $key
     * @return JiraIssueRequest
     */
    function createIssueRequestByKey($key);
    
}