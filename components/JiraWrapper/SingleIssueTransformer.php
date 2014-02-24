<?php

class SingleIssueTransformer implements ISingleIssueTransformer
{    
    public function createFromRawData($data)
    {
        $jsonData = json_decode($data);
        $issue = new JiraIssue($jsonData->key, 
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
                                $jsonData->fields->issuetype->iconUrl);
        
        return $issue;
    }

}
