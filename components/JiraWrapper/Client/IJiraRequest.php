<?php

interface IJiraRequest
{
    
    /**
     * @param JiraClient $client
     * @return IJiraResponsee
     */
    function send(IJiraClient $client);
    
}