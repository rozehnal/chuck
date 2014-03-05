<?php

namespace DixonsCz\Chuck\Jira;

interface IRequest
{
    
    /**
     * @param IClient $client
     * @return IResponse
     */
    function send(IClient $client);
    
}