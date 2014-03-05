<?php

namespace DixonsCz\Chuck\Jira;

interface IConfiguration
{
    
    /**
     * 
     * @return strhing
     */
    function getApiUrl();
    
    /**
     * 
     * @return strhing
     */
    function getUsername();
    
    /**
     * 
     * @return strhing
     */
    function getPassword();
    
}
