<?php

namespace DixonsCz\Chuck\Jira\Request;

interface IFactory
{
    
    /**
     * @param string $key
     * @return Issue
     */
    function createIssueRequestByKey($key);
    
}