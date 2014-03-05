<?php

namespace DixonsCz\Chuck\Jira;

interface IClient
{
    
    /**
     * 
     * @param string $path
     * @return Response
     */
    function requestPath($path);
    
}
