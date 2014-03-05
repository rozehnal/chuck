<?php

namespace DixonsCz\Chuck\Jira;

interface IResponse
{
    
    /**
     * @param Response\ITransformer $transformer
     * @reutrn mixed
     */
    function transform(Response\ITransformer $transformer);
    
}
