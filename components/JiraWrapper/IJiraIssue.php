<?php

interface IJiraIssue
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
     * @param IRevisionMessage $message
     */
    function attachRevisionMessage(IRevisionMessage $message);
    
}