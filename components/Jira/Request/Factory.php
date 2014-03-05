<?php

namespace DixonsCz\Chuck\Jira\Request;

class Factory implements IFactory
{
    /**
     * 
     * @param string $key
     * @return \DixonsCz\Chuck\Jira\Request\Issue
     */
    public function createIssueRequestByKey($key)
    {
        return new Issue($key);
    }

}