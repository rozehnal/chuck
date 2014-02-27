<?php

namespace DixonsCz\Chuck\Jira;

interface IResponse
{
    
    /**
     * @param IJiraResponseTransformer $transformer
     * @reutrn mixed
     */
    function transform(Response\ITransformer $transformer);
    
}
