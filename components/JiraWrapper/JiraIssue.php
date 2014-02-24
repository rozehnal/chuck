<?php

class JiraIssue
{
    protected $key;
    
    protected $summary;
    
    protected $asigneeName;
    
    protected $asigneeDisplayName;
    
    protected $reporter;
    
    protected $created;
    
    protected $updated;
    
    protected $description;
    
    protected $priority;
    
    protected $priorityIcon;
    
    protected $status;
    
    protected $statusIcon;
    
    protected $typeName;
    
    protected $typeIcon;
    
    public function __construct($key,
                                $summary,
                                $asigneeName,
                                $asigneeDisplayName,
                                $reporter,
                                $created,
                                $updated,
                                $description,
                                $priority,
                                $priorityIcon,
                                $status,
                                $statusIcon,
                                $typeName,
                                $typeIcon)
    {
        $this->asigneeDisplayName = $asigneeDisplayName;
        $this->asigneeName = $asigneeName;
        $this->created = $created;
        $this->description = $description;
        $this->key = $key;
        $this->priority = $priority;
        $this->priorityIcon = $priorityIcon;
        $this->reporter = $reporter;
        $this->status = $status;
        $this->statusIcon = $statusIcon;
        $this->summary = $summary;
        $this->typeIcon = $typeIcon;
        $this->typeName = $typeName;
        $this->updated = $updated;
    }
}
