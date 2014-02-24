<?php

class JiraClient implements IJiraClient
{
    
    /**
     *
     * @var IJiraConfiguration
     */
    protected $configuration;
    
    /**
     * 
     * @param IJiraConfiguration $config
     */
    public function __construct(IJiraConfiguration $config)
    {
        $this->configuration = $config;
    }
    
    /**
     * 
     * @param string $path
     * @return \JiraResponse
     */
    public function requestPath($path)
    {
        $requestUrl = $this->configuration->getApiUrl() . $path;
        $request = new Kdyby\Curl\Request($requestUrl);

        $request->headers['Authorization'] = 'Basic ' . base64_encode("{$this->configuration->getUsername()}:{$this->configuration->getPassword()}");
        $request->setFollowRedirects(TRUE);
        $responseBody = $request->get()->getResponse();
        return new JiraResponse($responseBody);
    }

}