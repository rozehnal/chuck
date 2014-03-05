<?php

namespace DixonsCz\Chuck\Jira;

class Response implements IResponse
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
     * @param Response\ITransformer $transformer
     * @return mixed
     */
    public function transform(Response\ITransformer $transformer)
    {
        return $transformer->createFromRawData($this->rawData);
    }

}