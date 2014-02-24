<?php

interface IJiraResponseTransformer
{
    
    /**
     * @param string $data
     * @return mixed
     */
    function createFromRawData($data);
    
}
