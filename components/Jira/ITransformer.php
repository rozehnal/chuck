<?php

interface ITransformer
{
    
    /**
     * @param string $data
     * @return mixed
     */
    function createFromRawData($data);
    
}
