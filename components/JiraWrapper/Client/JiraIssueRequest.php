<?php

class JiraIssueRequest implements IJiraRequest
{        
    protected $key;
    
    protected $path = 'issue/';
    
    public function __construct($key)
    {
        $this->key = $key;
    }
    
    /**
     * 
     * @param \IJiraClient $client
     * @return IJiraResponse
     */
    public function send(\IJiraClient $client)
    {
        return $client->requestPath($this->path . $this->key);
    }

}
