<?php

interface IJiraRequestsFactory
{
    
    /**
     * @param string $key
     * @return IssueRequest
     */
    function createIssueRequestByKey($key);
    
}