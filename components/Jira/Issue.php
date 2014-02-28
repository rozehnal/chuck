<?php

namespace DixonsCz\Chuck\Jira;

class Issue implements IIssue
{
    /**
     *
     * @var string
     */
    protected $key;
    
    /**
     *
     * @var string
     */
    protected $summary;
    
    /**
     *
     * @var string
     */
    protected $assigneeName;
    
    /**
     *
     * @var string
     */
    protected $asigneeDisplayName;
    
    /**
     *
     * @var string
     */
    protected $reporter;
    
    /**
     *
     * @var string
     */
    protected $created;
    
    /**
     *
     * @var string
     */
    protected $updated;
    
    /**
     *
     * @var string
     */
    protected $description;
    
    /**
     *
     * @var string
     */
    protected $priority;
    
    /**
     *
     * @var string
     */
    protected $priorityIcon;
    
    /**
     *
     * @var string
     */
    protected $status;
    
    /**
     *
     * @var string
     */
    protected $statusIcon;
    
    /**
     *
     * @var string
     */
    protected $typeName;
    
    /**
     *
     * @var string
     */
    protected $typeIcon;
    
    /**
     *
     * @var IRevisionMessage
     */
    protected $revisionMessage;
    
    /**
     * 
     * @param string $key
     * @param string $summary
     * @param string $assigneeName
     * @param string $asigneeDisplayName
     * @param string $reporter
     * @param string $created
     * @param string $updated
     * @param string $description
     * @param string $priority
     * @param string $priorityIcon
     * @param string $status
     * @param string $statusIcon
     * @param string $stringName
     * @param string $typeIcon
     */
    public function __construct($key,
                                $summary,
                                $assigneeName,
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
        $this->assigneeName = $assigneeName;
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
    
    /**
     * 
     * @return mixed[]
     */
    public function toArray()
    {
        $result = $this->toIssueArray();
        if ($this->revisionMessage != null)
        {
            $result['jira'] = $result;
            $result = array_merge($result, $this->revisionMessage->toArray());
        }
        
        return $result;
    }
    
    /**
     * 
     * @return mixed[]
     */
    protected function toIssueArray()
    {
        return array(
            'key'          => $this->key,
            'summary'      => $this->summary,
            'assignee' => array(
                    'name' => $this->assigneeName,
                    'displayName' => $this->asigneeDisplayName
            ),
            'reporter'     => $this->reporter,
            'created'      => $this->created,
            'updated'      => $this->updated,
            'description'  => $this->description,
            'priority'     => $this->priority,
            'priorityIcon' => $this->priorityIcon,
            'status'       => $this->status,
            'statusIcon'   => $this->statusIcon,
            'typeName'     => $this->typeName,
            'typeIcon'     => $this->typeIcon,
        );
    }
    
    /**
     * 
     * @param \DixonsCz\Chuck\Svn\IRevisionMessage $message
     */
    public function attachRevisionMessage(\DixonsCz\Chuck\Svn\IRevisionMessage $message)
    {
        $this->revisionMessage = $message;
    }

    /**
     * 
     * @return boolean
     */
    public function isBug()
    {
        return $this->typeName === 'Bug';
    }

    /**
     * 
     * @return boolean
     */
    public function isRFC()
    {
        return in_array($this->typeName, array('RFC', 'Technical task'));
    }

    /**
     * 
     * @return boolean
     */
    public function isSupportRequest()
    {
        return $this->typeName === 'Support Request';
    }

    /**
     * 
     * @return boolean
     */
    public function isOther()
    {
        return !in_array($this->typeName, array('Support Request', 'Bug', 'RFC', 'Technical task'));
    }

}
