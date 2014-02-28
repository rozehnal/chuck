<?php

namespace DixonsCz\Chuck\Jira\Issue\Tests\Fake;

class Repository implements \DixonsCz\Chuck\Jira\Issue\IRepository
{
    public function findIssueByKey($key)
    {
        $jsonData = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'jiraIssueResponse.json'));
        return new \DixonsCz\Chuck\Jira\Issue($key, 
                                        $jsonData->fields->summary, 
                                        $jsonData->fields->assignee->name, 
                                        $jsonData->fields->assignee->displayName, 
                                        $jsonData->fields->reporter->name, 
                                        $jsonData->fields->created, 
                                        $jsonData->fields->updated, 
                                        $jsonData->fields->description,
                                        $jsonData->fields->priority->name, 
                                        $jsonData->fields->priority->iconUrl, 
                                        $jsonData->fields->status->name, 
                                        $jsonData->fields->status->iconUrl, 
                                        $jsonData->fields->issuetype->name, 
                                        $jsonData->fields->issuetype->iconUrl
                                    );
    }

}