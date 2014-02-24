<?php

interface IJiraClient
{
    
    /**
     * 
     * @param string $path
     * @return \JiraResponse
     */
    function requestPath($path);
    
}
