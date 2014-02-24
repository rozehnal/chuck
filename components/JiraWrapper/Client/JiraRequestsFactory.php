<?php

class JiraRequestsFactory implements IJiraRequestsFactory
{
    public function createIssueRequestByKey($key)
    {
        return new JiraIssueRequest($key);
    }

}