<?php

namespace DixonsCz\Chuck\Jira\Issue;

class FromFileRepository implements IRepository
{
    /**
     *
     * @var string
     */
    protected $jiraJsonFile;

    /**
     *
     * @param string $jsonFile
     */
    public function __construct($jsonFile)
    {
        $this->jiraJsonFile = $jsonFile;
    }

    /**
     *
     * @param string $key
     * @return \DixonsCz\Chuck\Jira\Issue
     */
    public function findIssueByKey($key)
    {
        $jsonData = json_decode(file_get_contents($this->jiraJsonFile));
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