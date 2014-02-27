<?php

namespace DixonsCz\Chuck\Jira;

interface IRequest
{
    
    /**
     * @param Client $client
     * @return IJiraResponsee
     */
    function send(IClient $client);
    
}