<?php

namespace DixonsCz\Chuck\Jira;

class Configuration implements IConfiguration
{
    
    /**
     *
     * @var string[]
     */
    protected $credentials;
    
    /**
     *
     * @var string
     */
    protected $apiUrl;
    
    /**
     * 
     * @param string $apiUrl
     * @param string[] $credentials
     */
    public function __construct($apiUrl, array $credentials)
    {
        $this->apiUrl = $apiUrl;
        $this->credentials = $credentials;
    }
    
    /**
     * 
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * 
     * @return string
     */
    public function getPassword()
    {
        return $this->credentials['password'];
    }

    /**
     * 
     * @return string
     */
    public function getUsername()
    {
        return $this->credentials['user'];
    }

}
