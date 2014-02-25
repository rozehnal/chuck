<?php

interface IRevisionMessage
{
    /**
     * @return mixed[]
     */
    function toArray();
    
    /**
     * @param JiraWrapper $jiraWrapper
     * @return IJiraIssue
     */
    function findJiraIssue(JiraWrapper $jiraWrapper);
}
