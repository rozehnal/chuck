<?php

namespace DixonsCz\Chuck\Jira\Request;

class Factory implements IFactory
{
    public function createIssueRequestByKey($key)
    {
        return new IssueRequest($key);
    }

}