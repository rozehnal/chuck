<?php

namespace DixonsCz\Chuck\Jira\Request;

class Issue implements IRequest
{        
    protected $key;
    
    protected $path = 'issue/';
    
    public function __construct($key)
    {
        $this->key = $key;
    }
    
    /**
     * 
     * @param \IClient $client
     * @return IResponse
     */
    public function send(\IClient $client)
    {
        return $client->requestPath($this->path . $this->key);
    }

}
