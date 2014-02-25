<?php

/**
 * Example: https://jira.example.com/rest/api/latest/issue/EXPVY-325
 *
 * @author Michal Svec <michal.svec@dixonsretail.com>
 */
class JiraWrapper extends \Nette\Object
{
    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var
     */
    private $credentials;

    /**
     * @param string $apiUrl
     * @param array  $credentials
     */
    public function __construct($apiUrl, $credentials)
    {
        $this->apiUrl = (string) $apiUrl;
        $this->credentials = $credentials;
    }

    public function getTicketInfo($key)
    {
        $path = $this->apiUrl . "issue/" . $key;
        \Nette\Diagnostics\Debugger::barDump($path, "JIRA Request");

        $jsonData = null;

        try {
            $request = new Kdyby\Curl\Request($path);

            $request->headers['Authorization'] = 'Basic ' . base64_encode("{$this->credentials['user']}:{$this->credentials['password']}");
            $request->setFollowRedirects(TRUE);
            $responseBody = $request->get()->getResponse();
            $jsonData = json_decode($responseBody);
        } catch (\Kdyby\Curl\CurlException $e) {
            \Nette\Diagnostics\Debugger::log('Curl error: '.$e->getMessage(), \Nette\Diagnostics\Debugger::INFO);
        }
        if (!$jsonData) {
            return array();
        }

        \Nette\Diagnostics\Debugger::barDump($jsonData, "issue {$key}");

        $finalResult =  array(
            'key'          => $jsonData->key,
            'summary'      => $jsonData->fields->summary,
            'assignee' => array(
                'name' => $jsonData->fields->assignee->name,
                'displayName' => $jsonData->fields->assignee->displayName
            ),
            'reporter'     => $jsonData->fields->reporter->name,
            'created'      => $jsonData->fields->created,
            'updated'      => $jsonData->fields->updated,
            'description'  => $jsonData->fields->description,
            'priority'     => $jsonData->fields->priority->name,
            'priorityIcon' => $jsonData->fields->priority->iconUrl,
//			'environment'  => $jsonData->fields->customfield_10000->value,
            'status'       => $jsonData->fields->status->name,
            'statusIcon'   => $jsonData->fields->status->iconUrl,
            'typeName'     => $jsonData->fields->issuetype->name,
            'typeIcon'     => $jsonData->fields->issuetype->iconUrl,
            //'components' => $jsonData->fields->components->value,
        );

        \Nette\Diagnostics\Debugger::barDump($finalResult, "Jira data for {$key}");

        return $finalResult;
    }
}
