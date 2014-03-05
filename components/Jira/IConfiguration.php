<?php

namespace DixonsCz\Chuck\Jira;

interface IConfiguration
{
    
    /**
     * 
     * @return string
     */
    function getApiUrl();
    
    /**
     * 
     * @return string
     */
    function getUsername();
    
    /**
     * 
     * @return string
     */
    function getPassword();
    
}
