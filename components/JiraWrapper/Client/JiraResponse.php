<?php

class JiraResponse implements IJiraResponse
{
    /**
     *
     * @var string
     */
    protected $rawData;
    
    /**
     * 
     * @param string $responseBody
     */
    public function __construct($responseBody)
    {
        $this->rawData = $responseBody;
    }
    
    /**
     *     
     * @param \IJiraResponseTransformer $transformer
     * @return mixed
     */
    public function transform(\IJiraResponseTransformer $transformer)
    {
        return $transformer->createFromRawData($this->rawData);
    }

}