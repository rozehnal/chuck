<?php

namespace DixonsCz\Chuck\Jira;

interface IClient
{
    
    /**
     * 
     * @param string $path
     * @return \JiraResponse
     */
    function requestPath($path);
    
}
