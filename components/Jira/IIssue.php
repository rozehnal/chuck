<?php

namespace DixonsCz\Chuck\Jira;

interface IIssue
{
    
    /**
     * @return mixed[]
     */
    function toArray();
    
    /**
     * @return bool
     */    
    function isRFC();
    
    /**
     * @return bool
     */    
    function isBug();
    
    /**
     * @return bool
     */    
    function isSupportRequest();
    
    /**
     * @return bool
     */
    function isOther();
    
    /**
     * @param \DixonsCz\Chuck\Svn\IRevisionMessage $message
     */
    function attachRevisionMessage(\DixonsCz\Chuck\Svn\IRevisionMessage $message);
    
}