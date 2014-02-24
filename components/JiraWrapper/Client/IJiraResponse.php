<?php

interface IJiraResponse
{
    
    /**
     * @param IJiraResponseTransformer $transformer
     * @reutrn mixed
     */
    function transform(IJiraResponseTransformer $transformer);
    
}
